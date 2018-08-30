<?php

namespace application\models;

use application\core\Model;
use application\core\View;
use application\lib\Helper;

/**
 * Class Client
 * @package application\models
 */
class Client extends Model
{
    /**
     * @var array
     */
    public $error = [];

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const USER_PER_PAGE = 10;

    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $login;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $firstname;
    /**
     * @var string
     */
    public $lastname;
    /**
     * @var int
     */
    public $gender;
    /**
     * @var string (date)
     */
    public $dob;

    public $dirtyLogin;
    public $dirtyPassword;

    /**
     * @return bool
     * Method validation fields user
     */
    public function validateUser()
    {
        if ($this->login != $this->dirtyLogin && $this->db->exists('user', 'login', $this->login)) {
            $this->error['login'] = 'Такой логин уже существует';
        } else if (mb_strlen($this->login) < 3 || mb_strlen($this->login) > 25) {
            $this->error['login'] = 'Поле «Логин» должно содержать от 3 до 25 символов';
        }

        if($this->isNewRecord() && (mb_strlen($this->password) < 6 || mb_strlen($this->password) > 64)) {
            $this->error['password'] = 'Поле «Пароль» должно содержать от 6 до 64 символов';
        } else if (!$this->isNewRecord() && ($this->password !== null && $this->password != '')) {
            if(mb_strlen($this->password) < 6 || mb_strlen($this->password) > 64) {
                $this->error['password'] = 'Поле «Пароль» должно содержать от 6 до 64 символов';
            }
        }
        if (mb_strlen($this->firstname) < 2 or mb_strlen($this->firstname) > 64) {
            $this->error['firstname'] = 'Поле «Имя» должно содержать от 2 до 64 символов';
        }
        if (mb_strlen($this->lastname) < 2 or mb_strlen($this->lastname) > 64) {
            $this->error['lastname'] = 'Поле «Фамилия» должно содержать от 2 до 64 символов';

        }
        if (!array_key_exists($this->gender, self::getGenderList())) {
            $this->error['gender'] = 'Поле «Пол» выбрано неправильно';
        }

        if ($this->dob == '') {
            $this->error['dob'] = 'Поле «Дата рождения» не должно быть пустым';
        } else if (!is_numeric(strtotime($this->dob)) && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $post['dob'])) {
            $this->error['dob'] = 'Поле «Дата рождения» имеет неправильный формат';
        } else if (strtotime($this->dob) >= strtotime(date('d.m.Y'))) {
            $this->error['dob'] = 'Поле «Дата рождения» не может быть больше или равно сегодняшнему дню';
        }

        if (!empty($this->error)) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     * Method list gender
     */
    public static function getGenderList()
    {
        return [
            self::GENDER_MALE => 'Мужчина',
            self::GENDER_FEMALE => 'Женщина',
        ];
    }

    /**
     * @return mixed|null
     * Method get gender value by key
     */
    public function getGender()
    {
        return Helper::arrayGetValue(self::getGenderList(), $this->gender);
    }

    /**
     * @return bool
     * Method for check row New or Exists
     */
    public function isNewRecord()
    {
        if ($this->id !== null && $this->db->exists('user', 'id', $this->id)) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * @return bool
     * Method save model, insert or update row
     */
    public function save()
    {
        if ($this->validateUser()) {

            $params = [
                'id' => $this->id,
                'login' => $this->login,
                'password' => $this->password == '' ? $this->dirtyPassword : md5($this->password),
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'gender' => $this->gender,
                'dob' => $this->dob,
            ];

            if ($this->isNewRecord()) {

                $this->db->query('INSERT INTO user (id, login, password, firstname, lastname, gender, dob) VALUES (:id, :login, :password, :firstname, :lastname, :gender, :dob)', $params);
                if ($this->db->lastInsertId() > 0) {
                    $this->id = $this->db->lastInsertId();
                    return true;
                }
            } else {
                $this->db->query('UPDATE user SET login = :login, password = :password, firstname = :firstname, lastname = :lastname, gender = :gender, dob = :dob WHERE id = :id', $params);
                return true;
            }
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     * Method find row and set attributes
     */
    public function findOne($id)
    {
        $data = $this->db->row('SELECT * FROM user WHERE id = :id LIMIT 1', ['id' => $id]);
        if (!empty($data)) {
            $this->setAttributes($data[0]);
            return true;
        }
        View::errorCode(404);

    }

    /**
     * @param $data
     * Method set attributes and set old(dirty) attributes
     */
    public function setAttributes($data)
    {
        $this->dirtyLogin = $this->login ?? null;
        $this->dirtyPassword = $this->password ?? null;

        $this->id = isset($data['id']) ? (int)$data['id'] : null;
        $this->login = $data['login'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->firstname = $data['firstname'] ?? null;
        $this->lastname = $data['lastname'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->dob = $data['dob'] ?? null;
    }

    /**
     * Method delete user
     */
    public function delete()
    {
        $this->db->query('DELETE FROM user WHERE id = :id', ['id' => $this->id]);
    }

    /**
     * @return mixed
     * Method Count user
     */
    public function getUserCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM user WHERE role <> :role', ['role' => Auth::ROLE_ADMIN]);
    }

    /**
     * @param $page
     * @param $max
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getUserList($page = 1, $max = 10, $sort = 'login', $order = 'asc')
    {
        $page = !is_numeric($page) || $page < 0 ? 1 : $page;
        $params = [
            'role' => Auth::ROLE_ADMIN,
            'max' => $max,
            'start' => ((($page ?? 1) - 1) * $max),
        ];

        return $this->db->row('SELECT * FROM user WHERE role != :role ORDER BY ' . $sort . ' ' . $order . ' LIMIT :start, :max', $params);
    }

}
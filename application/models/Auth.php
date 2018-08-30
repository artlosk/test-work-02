<?php

namespace application\models;

use application\core\Model;

/**
 * Class Auth
 * @package application\models
 */
class Auth extends Model
{
    /**
     * @var string
     */
    public $error;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /**
     * @param $post
     * @return bool
     * Method check access
     */
    public function loginValidate($post)
    {
        $params = [
            'login' => $post['login'],
            'password' => md5($post['password']),
            'role' => self::ROLE_ADMIN
        ];
        $isExist = $this->db->column('SELECT id FROM user WHERE login = :login AND password = :password AND role = :role', $params);
        if (!$isExist) {
            $this->error = 'Логин или пароль указан неверно';
            return false;
        }
        return true;
    }

}
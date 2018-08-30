<?php

namespace application\lib;

use PDO;

/**
 * Class Db
 * @package application\lib
 */
class Db
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * Db constructor.
     */
    public function __construct()
    {
        $config = require 'application/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'], $config['password']);
    }

    /**
     * @param $sql
     * @param array $params
     * @return \PDOStatement
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * @param $table
     * @param $field
     * @param $value
     * @return mixed
     */
    public function exists($table, $field, $value)
    {
        return $this->column('SELECT id FROM ' . $table . ' WHERE ' . $field . ' = :' . $field, [$field => $value]);
    }

}
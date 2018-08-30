<?php

namespace application\core;

use application\lib\Db;

/**
 * Class Model
 * @package application\core
 */
abstract class Model
{
    /**
     * @var Db
     */
    public $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new Db;
    }

}
<?php

namespace classes;

use PDO;
abstract class Model
{
    public $db;
    protected $qb;

    public function __construct()
    {
        try {
            $this->db = new PDO(DBN,DB_USER,DB_PWD);
        } catch(PDOException $exception) {
            die($exception->getMessage());
        }
        $this->db->exec("SET NAMES UTF8");

        $this->qb = new QueryBuilder();
    }

    public function exists($table, $champ, $param)
    {
        $count = $this->qb
            ->table($table)
            ->where($champ, $param)
            ->count();
        return (bool) $count;
    }
}
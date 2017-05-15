<?php

namespace classes;


abstract class Model
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(DBN,DB_USER,DB_PWD);
        } catch(PDOException $exception) {
            die($exception->getMessage());
        }
        $this->db->exec("SET NAMES UTF8");
    }
}
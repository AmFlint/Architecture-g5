<?php

namespace classes;

use PDO;

final class QueryBuilder
{

    /**
     * @var
     */
    public $parameters;
    /**
     * @var
     */
    public $condition;
    /**
     * @var
     */
    public $query;
    /**
     * @var
     */
    public $table;
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var
     */
    public $values;
    /**
     * @var
     */
    public $array_parameters;
    /**
     * @var
     */
    private $stmt;
    /**
     * @var
     */
    public $limit;
    /**
     * @var
     */
    public $offset;

    public $columns;

    public $joint;

    /**
     * QueryBuilder constructor.
     */
    public function __construct()
    {
        $this->db = new PDO(DBN, DB_USER, DB_PWD);
        $this->db->exec("SET NAMES UTF8");
        $this->resetQuery();
    }

    /**
     * @param $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = '`'.$table.'`';
        return $this;
    }

    /**
     * @param $param
     * @param bool $alias
     * @return $this
     */
    public function select(array $param, array $alias = array())
    {
//        if (!empty($this->parameters)) {
//            $this->parameters .= ', ';
//        }
//
//        $this->parameters .= $param;
//        if ($alias) {
//            $this->parameters .= ' AS ' . $alias;
//        }

//        return $this;
        $this->parameters .= $param[0];
        if (isset($alias[0]) && trim($alias[0]) != '') {
            $this->parameters .= ' AS ' . $alias[0];
        }

        $count = count($param);
        if ($count < 2) {
            return $this;
        }
        for ($i = 1; $i < $count; $i++) {
            $this->parameters .= ", " . $param[$i];
            if (isset($alias[$i]) && trim($alias[$i]) != '') {
                $this->parameters .= ' AS ' . $alias[$i];
            }
        }

        return $this;
    }

    /**
     * @param $param
     * @param $value
     * @param string $operation
     * @return $this
     */
    public function where($param, $value, $operation = "=")
    {
        if (empty($this->condition)){
            $this->condition = " WHERE 1";
        }
        $to_bind = implode('', explode('.', $param));
        $this->condition .= ' AND ' . $param . ''. ' ' . $operation . ' ' . ':' . $to_bind;
        array_push($this->values, $value);
        array_push($this->array_parameters, $to_bind);
        return $this;
    }

    public function join($table, $type)
    {
        if (trim($this->joint) != '') { // if function "on()" called before join
            $this->joint .= ', ';
        }
        $this->joint = ' ' . strtoupper($type) . ' JOIN `' . $table . '` ';
        return $this;
    }

    public function on(string $parameter1, string $parameter2)
    {
        $this->joint .= 'ON ' . $parameter1 . ' = ' . $parameter2;
        return $this;
    }

    /**
     * @param $num_start
     * @param bool $num_end
     * @return $this
     */
    public function limit($num_start, $num_end = false)
    {
        $this->limit = ' LIMIT ' .$num_start;
        if ($num_end) {
            $this->limit .= ', ' . $num_end;
        }
        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = " OFFSET " . $offset;
        return $this;
    }

    /**
     * @param array $array_param
     * @return $this
     */
    public function addColumns(array $array_param)
    {
        $this->columns = ' ( ' . $array_param[0];
        array_push($this->array_parameters, $array_param[0]);
        $count = count($array_param);
        for ($i = 1; $i < $count; $i++) {
            $this->columns .= ", " . $array_param[$i];
            array_push($this->array_parameters, $array_param[$i]);
        }
        $this->columns .= ') VALUES( :' . $array_param[0];
        for ($i = 1; $i < $count; $i++) {
            $this->columns .= ", :" . $array_param[$i];
        }
        $this->columns .= ') ';
        return $this;
    }

    /**
     * @param array $array_param
     */
    public function updateColumns(array $array_param)
    {
        $this->columns = $array_param[0] . ' = :' . $array_param[0];
        array_push($this->array_parameters, $array_param[0]);
        $count = count($array_param);
        if ($count < 2) {
            return $this;
        }
        for ($i = 1; $i < $count; $i++) {
            $this->columns .= ', ' . $array_param[$i] . ' = :' . $array_param[$i];
            array_push($this->array_parameters, $array_param[$i]);
        }
        return $this;
    }

    /**
     * @param array $arrayParams
     * @return $this
     */
    public function values(array $arrayParams)
    {
        foreach ($arrayParams as $value) {
            array_push($this->values, $value);
        }
        return $this;
    }

    /**
     * @param string $crud
     */
    private function setQuery($crud = "select")
    {
        if ($crud == "select") {
            $this->query = 'SELECT ' . $this->parameters .' FROM ' . $this->table . $this->joint . $this->condition . $this->limit . $this->offset;
        } else if ($crud == "add") {
            $this->query =  'INSERT INTO ' . $this->table . $this->columns;
        } else if ($crud == 'update') {
            $this->query = 'UPDATE ' . $this->table . ' SET ' . $this->columns . $this->condition;
        } else if ($crud == 'delete') {
            $this->query = 'DELETE FROM ' . $this->table . $this->condition . $this->limit;
        }
    }

    /**
     *
     */
    private function resetQuery()
    {
        $this->parameters = $this->columns = $this->query = $this->condition = $this->joint = $this->stmt = $this->limit = $this->offset = '';
        $this->values = $this->array_parameters = array();
    }

    /**
     *
     */
    private function bind()
    {
        $count = count($this->values);
        for ($i = 0; $i < $count; $i++) {
            $this->stmt->bindValue(':'.$this->array_parameters[$i], $this->values[$i]);
        }
    }

    /**
     * @return mixed
     */
    private function resultSet()
    {
        $this->stmt->execute();
        $row = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->resetQuery();
        return $row;
    }

    /**
     * @return string
     */
    public function count()
    {
        $this->parameters = "COUNT(*)";
        $this->limit = $this->offset = '';
        $this->setQuery();
        $this->stmt = $this->db->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $row = $this->stmt->fetchColumn();
        $this->resetQuery();
        return $row;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->condition = ' WHERE 1';
        $this->setQuery();
        $this->stmt = $this->db->prepare($this->query);
        $row = $this->resultSet();
        return $row;
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        $this->condition = "";
        $this->limit = "LIMIT 1";
        $this->setQuery();
        $this->stmt = $this->db->prepare($this->query);
        $row = $this->resultSet();
        return $row;
    }


    /**
     * @return mixed
     */
    public function get()
    {
        $this->setQuery();
        $this->stmt = $this->db->prepare($this->query);
        $this->bind();
        $row = $this->resultSet();
        return $row;
    }

    /**
     *
     */
    public function add()
    {
        $this->setQuery('add');
        $this->stmt = $this->db->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $this->resetQuery();
    }

    /**
     *
     */
    public function update()
    {
        $this->setQuery('update');
        $this->stmt = $this->db->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $this->resetQuery();
    }

    /**
     *
     */
    public function delete()
    {
        $this->limit = " LIMIT 1";
        $this->setQuery('delete');
        $this->stmt = $this->db->prepare($this->query);
        $this->bind();
        $this->stmt->execute();
        $this->resetQuery();
    }

}
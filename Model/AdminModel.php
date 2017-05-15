<?php

namespace Model;


use classes\Model;
use classes\QueryBuilder;

class AdminModel extends Model
{
    public function getMagazines()
    {
        $qb = new QueryBuilder();
        $row = $qb->table('actualites')->select(array('id', 'title'))->getAll();
        return $row;
    }
}
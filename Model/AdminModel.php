<?php

namespace Model;


use classes\Model;
use classes\QueryBuilder;

class AdminModel extends Model
{
    public function getMagazines()
    {
        $qb = new QueryBuilder();
        $row = $qb->table('magazines')->select(array('id', 'title'))->getAll();
        return $row;
    }

    public function getMagazine($id)
    {
        $qb = new QueryBuilder();
        $row = $qb->table('magazines')->select(array('id', 'title', 'synopsis', 'image'))->where('id', $id)->get();
        return $row;
    }
}
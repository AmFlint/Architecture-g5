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
        $row = $qb->table('magazines')->select(array('id', 'title', 'synopsis', 'image', 'link', 'date'))->where('id', $id)->get();
        return $row;
    }

    public function setMagazines()
    {
        $qb = new QueryBuilder();
        $qb->updateColumns(array('title', 'synopsis', 'image', 'link', 'date'))->values(array($_POST['title'], $_POST['synopsis'], $_POST['image'], $_POST['link'], $_POST['date']))->where('id', $_POST['id'])->table('magazines')->update();
        header('Location: /admin');
    }
}
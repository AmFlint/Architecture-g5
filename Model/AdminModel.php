<?php

namespace Model;


use classes\Model;
use classes\QueryBuilder;

class AdminModel extends Model
{
    private $qb;

    public function __construct()
    {
        parent::__construct();
        $this->qb = new QueryBuilder();

    }

    public function getMagazines()
    {
        $row = $this->qb->table('magazines')->select(array('id', 'title'))->getAll();
        return $row;
    }

    public function getMagazine($id)
    {
        $row = $this->qb
            ->table('magazines')
            ->select(array('id', 'title', 'synopsis', 'image', 'secondary_image', 'link', 'date', 'location_id', 'secondary_location'))
            ->where('id', $id)
            ->get();
        return $row;
    }

    public function setMagazines()
    {
        $this->qb->updateColumns(array('title', 'synopsis', 'image', 'link', 'date'))->values(array($_POST['title'], $_POST['synopsis'], $_POST['image'], $_POST['link'], $_POST['date']))->where('id', $_POST['id'])->table('magazines')->update();
        header('Location: /admin');
    }

    public function deleteMagazine($id)
    {
        $this->qb->where('id', $id)->table('magazines')->delete();
        header('Location: /admin');
    }

    public function getPartners($id, $secondary)
    {
        $row = $this->qb
            ->select(array('id', 'name'))
            ->table('partenaires')
            ->where('location_id', $id)
            ->where('location_id', $secondary, ' OR ')
            ->get();
        return $row;
    }

    public function getActualPartners($id)
    {
        $row = $this->qb
            ->select(array('partenaires.id', 'partenaires.name'), array('partner_id', 'partner_name'))
            ->table('partenaires')
            ->join('partenariat', 'inner')
            ->on('partenaires.id','partenariat.partenaire_id')
            ->where('partenariat.magazine_id', $id)
            ->get();
        return $row;
    }
}
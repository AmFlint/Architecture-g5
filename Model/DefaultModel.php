<?php

namespace Model;

use classes\Model;

class DefaultModel extends Model
{
    public function addContact()
    {
        $this->qb
            ->addColumns(array(
                'raison_sociale',
                'nom',
                'telephone',
                'mail',
                'service',
                'message',
                'object',
                'date'))
            ->values(array(
                $_POST['raison_sociale'],
                $_POST['nom'],
                $_POST['telephone'],
                $_POST['mail'],
                $_POST['service'],
                $_POST['message'],
                $_POST['object'],
                date('Y-m-d')))
            ->table('contact')
            ->add();
        header('Location: ' . ROOT_URL . '');
    }

    public function subscribe()
    {
        $this->qb
            ->addColumns(array(
                'raison_sociale',
                'activite',
                'nom',
                'prenom',
                'fonction',
                'adresse',
                'code_postal',
                'ville',
                'pays',
                'telephone',
                'fax',
                'mail',
                'zone_geographique',
                'revue',
                'quantite',
                'commande_id',
                'date_add'))
            ->values(array(
                $_POST['raison_sociale'],
                $_POST['activite'],
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['fonction'],
                $_POST['adresse'],
                $_POST['code_postal'],
                $_POST['ville'],
                $_POST['pays'],
                $_POST['telephone'],
                $_POST['fax'],
                $_POST['mail'],
                $_POST['zone_geographique'],
                $_POST['revue'],
                $_POST['quantite'],
                $_POST['commande_id'],
                date('Y-m-d')))
            ->table('commande')
            ->add();
        header('Location: ' . ROOT_URL . '');
    }

    public function getOffer()
    {
        $row = $this->qb
            ->select([
                'name',
                'link'
            ])
            ->table('partenaires')
            ->where('visible_front', 1)
            ->get();
        return $row;
    }

    public function getFrontMagazines()
    {
        $row = $this->qb
            ->select([
                'magazines.id',
                'magazines.title',
                'magazines.image',
                'location.location',
                'magazines.date'
            ])
            ->limit(8)
            ->join('location', 'inner')
            ->on('location.id', 'magazines.location_id')
            ->table('magazines')
            ->get();
        return $row;
    }

    public function getNewMagazines()
    {
        $row = $this->qb
            ->table('magazines')
            ->select(array(
                'magazines.id',
                'magazines.title',
                'magazines.synopsis',
                'magazines.image',
                'magazines.secondary_image',
                'magazines.link',
                'magazines.date',
                'magazines.location_id',
                'magazines.secondary_location',
                'l1.location as location',
                'l2.location as secondary_location'))
            ->join('location as l1', 'inner')
            ->on('magazines.location_id', 'l1.id')
            ->join('location as l2', 'inner')
            ->on('magazines.secondary_location', 'l2.id')
            ->limit(20)
            ->orderBy('date', 'DESC')
            ->get();
        return $row;
    }
}
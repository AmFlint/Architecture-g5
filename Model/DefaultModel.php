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
                'message'))
            ->values(array(
                $_POST['raison_sociale'],
                $_POST['nom'],
                $_POST['telephone'],
                $_POST['mail'],
                $_POST['service'],
                $_POST['message']))
            ->table('contact')
            ->add();
        header('Location: /');
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
        header('Location: /');
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
}
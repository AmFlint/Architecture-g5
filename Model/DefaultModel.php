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

}
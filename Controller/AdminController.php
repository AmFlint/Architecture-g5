<?php
/**
 * Created by PhpStorm.
 * User: antoinemasselot
 * Date: 15/05/2017
 * Time: 10:39
 */

namespace Controller;


class AdminController
{
    public function listingAction()
    {
        echo 'backoffice admin';
    }

    public function showMagazineAction($id)
    {
        echo "c'est le magazine " . $id;
    }
}
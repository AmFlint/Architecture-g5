<?php
/**
 * Created by PhpStorm.
 * User: antoinemasselot
 * Date: 15/05/2017
 * Time: 10:39
 */

namespace Controller;


use classes\Controller;
use Model\AdminModel;
use Model\DefaultModel;
use PDO;

class AdminController extends Controller
{
    public function listingAction()
    {
        $model = new AdminModel();
        $actualites = $model->getMagazines();
        $lol = [["test" => "salut"], ["test" => "prenom"]];
        echo  self::$twig[0]->render(
            "admin.html.twig",
            [
                "magazines" => $actualites
            ]
        );
    }

    public function showMagazineAction($id)
    {
        echo "c'est le magazine " . $id;
    }
}
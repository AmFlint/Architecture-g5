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
        $model = new AdminModel();
        $magazine = $model->getMagazine($id);
        echo  self::$twig[0]->render(
            "single_magazine.html.twig",
            [
                "magazine" => $magazine[0]
            ]
        );
    }

    public function showFormAction($id)
    {
        $model = new AdminModel();
        $magazine = $model->getMagazine($id);
        echo  self::$twig[0]->render(
            "form_edit_magazine.html.twig",
            [
                "magazine" => $magazine[0]
            ]
        );
    }

    public function editMagazineAction($id)
    {
        $model = new AdminModel();
        $revue = $model->setMagazines();
    }
}
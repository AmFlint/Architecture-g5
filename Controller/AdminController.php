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
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminModel();
    }

    public function listingAction()
    {
        $actualites = $this->model->getMagazines();
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
        $magazine = $this->model->getMagazine($id);
        echo  self::$twig[0]->render(
            "single_magazine.html.twig",
            [
                "magazine" => $magazine[0]
            ]
        );
    }

    public function showFormAction($id)
    {
        $magazine = $this->model->getMagazine($id);
        echo  self::$twig[0]->render(
            "form_edit_magazine.html.twig",
            [
                "magazine" => $magazine[0]
            ]
        );
    }

    public function editMagazineAction($id)
    {
        $revue = $this->model->setMagazines();
    }

    public function deleteMagazineAction($id)
    {
        $this->model->deleteMagazine($id);
    }


}
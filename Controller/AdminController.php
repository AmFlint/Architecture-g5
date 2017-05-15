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
        $partenaires = $this->model->getPartners($magazine[0]['location_id'],$magazine[0]['secondary_location']);
        $partenaires_actuels = $this->model->getActualPartners($id);
        echo  self::$twig[0]->render(
            "form_edit_magazine.html.twig",
            [
                "magazine" => $magazine[0],
                "list_partenaires" => $partenaires,
                "actual_partenaires" => $partenaires_actuels
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

    public function showAddMagazineAction()
    {
        echo  self::$twig[0]->render(
            "form_add_magazine.html.twig",
            [

            ]
        );
    }

    public function addMagazineAction()
    {
        $this->model->addMagazine();
    }



}
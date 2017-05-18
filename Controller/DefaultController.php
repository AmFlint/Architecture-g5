<?php

namespace Controller;

use classes\Controller;
use classes\QueryBuilder;
use Model\DefaultModel;

class DefaultController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new DefaultModel();
    }

    public function fooAction()
    {
        echo "salut";
    }

    public function chickAction()
    {
        $count = $this->model->exists('location', 'location', 'Belgique');
        echo $count;
    }

    public function contactAction()
    {
        echo  self::$twig[0]->render(
            "form_contact.html.twig",
            [

            ]
        );
    }

    public function addContactAction()
    {
        $this->model->addContact();
    }

    public function testAction($id, $test)
    {
        echo 'je suis l\'article '.$id . ' et je suis ' . $test;
        echo  self::$twig[0]->render(
            "home.html.twig",
            [
                "prenom" => $test,
                "age"    => $id
            ]
        );
        $qb = new QueryBuilder();
        $qb->updateColumns(array('nom', 'degats'))->values(array('mate', 2))->where('id', '2')->table('personnages')->update();
        $qb->table('personnages')->where('id', 3)->delete();
        $test = $qb->table('cours')->select(array("cours.name", "tags.name"), array('', 'tag'))->join('tags', 'inner')->on('cours.tag_id', 'tags.id')->where('tags.name', 'medicament')->get();
        var_dump($test);
    }

    public function  subscribeFormAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo  self::$twig[0]->render(
                "form_subscribe.html.twig",
                [
                ]
            );
        }
        else {
            $_POST['commande_id'] = 1;
            $this->model->subscribe();
        }
    }

    public function showOfferAction()
    {
        $offer = $this->model->getOffer();
        echo self::$twig[0]->render(
            "appel_offre.html.twig",
            [
                'offer' => $offer[0]
            ]
        );
    }

    public function  commandeFormAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo  self::$twig[0]->render(
                "front_commande.html.twig",
                [
                ]
            );
        }
        else {
            $_POST['commande_id'] = 2;
            $this->model->subscribe();
        }
    }

    public function homeAction()
    {
        $magazines = $this->model->getFrontMagazines();
        $classes = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
        echo  self::$twig[0]->render(
            "front_index.html.twig",
            [
                'magazines' => $magazines,
                'classes'   => $classes
            ]
        );
    }

    public function showNewMagazinesAction()
    {
        $magazines = $this->model->getNewMagazines();
        echo  self::$twig[0]->render(
            "front_dernieres_parutions.html.twig",
            [
                'magazines' => $magazines
            ]
        );
    }

    public function showAllMagazinesAction()
    {
        $magazines = $this->model->getAllMagazines();
        $locations = $this->model->getAllLocations();
        echo  self::$twig[0]->render(
            "front_toutes_parutions.html.twig",
            [
                'magazines' => $magazines,
                'locations' => $locations
            ]
        );
    }

    public function loadSingleMagazineAction($id)
    {
        $magazine = $this->model->getSingleMag($id);
        $partners = $this->model->getActualPartners($id);
        if(!$magazine) {
            header('Location: ' . ROOT_URL . 'toutes-les-revues');
            exit;
        }
        echo  self::$twig[0]->render(
            "front_single_parution.html.twig",
            [
                'magazine' => $magazine[0],
                'partners' => $partners
            ]
        );
    }

    public function loadSingleActuAction($slug)
    {
        $actualite = $this->model->getSingleActu($slug);
        if (!$actualite) {
            header('Location: ' + ROOT_URL + 'actualites');
            exit;
        }
        echo  self::$twig[0]->render(
            "front_single_actu.html.twig",
            [
                'actualite' => $actualite[0]
            ]
        );
    }

    public function listingActuAction()
    {
        $actualites = $this->model->getAllActu();
        echo  self::$twig[0]->render(
            "front_listing_actualites.html.twig",
            [
                'actualites' => $actualites
            ]
        );
    }
}
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
    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminModel();
    }

    public function listingAction()
    {
        $magazines = $this->model->getMagazines();
        echo  self::$twig[0]->render(
            "admin.html.twig",
            [
                "magazines" => $magazines
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
        if ($_POST['localisation_secondaire'] != '' && is_string($_POST['localisation_secondaire'])) {
            if ($this->model->exists('location', 'location', $_POST['localisation_secondaire'])) {
                $localisation_secondaire = $this->model->getLocId($_POST['localisation_secondaire'])[0]['id'];
            } else {
                $localisation_secondaire = $this->model->addLocation($_POST['localisation_secondaire']);
            }
        } else {
            $localisation_secondaire = 6;
        }

        if ($this->model->exists('location', 'location', $_POST['localisation'])) {
            $localisation = $this->model->getLocId($_POST['localisation'])[0]['id'];
        } else {
            $localisation = $this->model->addLocation($_POST['localisation']);
        }

        $this->model->setMagazines($localisation, $localisation_secondaire);
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
        if ($_POST['localisation_secondaire'] != '' && is_string($_POST['localisation_secondaire'])) {
            if ($this->model->exists('location', 'location', $_POST['localisation_secondaire'])) {
                $localisation_secondaire = $this->model->getLocId($_POST['localisation_secondaire'])[0]['id'];
            } else {
                $localisation_secondaire = $this->model->addLocation($_POST['localisation_secondaire']);
            }
        } else {
            $localisation_secondaire = 6;
        }

        if ($this->model->exists('location', 'location', $_POST['localisation'])) {
            $localisation = $this->model->getLocId($_POST['localisation'])[0]['id'];
        } else {
            $localisation = $this->model->addLocation($_POST['localisation']);
        }

        $this->model->addMagazine($localisation, $localisation_secondaire);
    }

    public function showMessagesAction()
    {
        $messages = $this->model->getMessages();
        echo  self::$twig[0]->render(
            "admin_contact.html.twig",
            [
                "messages" => $messages
            ]
        );
    }

    public function showSingleMessageAction($id)
    {
        $message = $this->model->getMessage($id);
        echo  self::$twig[0]->render(
            "admin_single_message.html.twig",
            [
                "message" => $message[0]
            ]
        );
    }

    public function showActualitesAction()
    {
        $actualites = $this->model->getActu();
        echo  self::$twig[0]->render(
            "admin_actualites_listing.html.twig",
            [
                "actualites" => $actualites
            ]
        );
    }

    public function showActualiteSingleAction($id)
    {
        $actualite = $this->model->getActuSingle($id);
        echo  self::$twig[0]->render(
            "admin_actualite_single.html.twig",
            [
                "actualite" => $actualite[0]
            ]
        );
    }

    public function showPartnersAction()
    {
        $partners = $this->model->getAllPartners();
        echo  self::$twig[0]->render(
            "admin_partners.html.twig",
            [
                "partners" => $partners
            ]
        );
    }

    public function setVisibleAction($id)
    {
        $this->model->setVisible($id);
    }

    public function deletePartnerAction($id)
    {
        $this->model->deletePartner($id);
    }

    public function editFormPartnerAction($id)
    {
        $partner = $this->model->getPartner($id);
        echo  self::$twig[0]->render(
            "admin_partners_edit.html.twig",
            [
                "partner" => $partner[0]
            ]
        );
    }

    public function editPartnerAction($id)
    {
        if ($this->model->exists('location', 'location', $_POST['localisation'])) {
            $localisation = $this->model->getLocId($_POST['localisation'])[0]['id'];
        } else {
            $localisation = $this->model->addLocation($_POST['localisation']);
        }
        $this->model->updatePartner($id, $localisation);
    }

    public function showCommandesAction()
    {
        $totalcommandes = $this->model->getCommandes();
        echo  self::$twig[0]->render(
            "list_commande.html.twig",
            [
                "commandes" => $totalcommandes
            ]
        );
    }

    public function showSingleCommandeAction($id)
    {
        $commande = $this->model->getCommande($id);
        echo self::$twig[0]->render(
            "admin_single_commande.html.twig",
            [
                "commande" => $commande[0]
            ]
        );
    }

    public function addActualitesAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo  self::$twig[0]->render(
                "admin_actualites_add.html.twig",
                [
                ]
            );
        }
        else {
            $this->model->addActualites();
        }

    }

}
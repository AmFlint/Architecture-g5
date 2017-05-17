<?php

namespace Model;


use classes\Model;
use classes\QueryBuilder;

class AdminModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function upload($image)
    {
        // Définition du dossier de destination
        $dossier = 'assets/img-content/';
// Définition du nom du fichier uploadé dans la variable fichier
        $fichier = basename($_FILES[$image]['name']);
// Création de la variable pour la taille max en octets
        $taille_maxi = 100000;
// Evaluation de la taille du fichier uploadé
        $taille_fichier = filesize($_FILES[$image]['tmp_name']);
// On définie les extensions autorisée par le système (images)
        $extensions_ok = array('.png', '.jpg', '.jpeg');
// On va chercher l'extension du fichier uploadé dans edit-form.php
        $extension_fichier = strrchr($_FILES[$image]['name'], '.');

// On vérie maintenant l'extension du fichier
        if(!in_array($extension_fichier, $extensions_ok))
        {
            // Créer une variable erreur qu'on va afficher plus loin si probleme
            $erreur = 'Extension non respectée';
        }
// Vérification des erreurs, si il n'y a pas d'erreur, on continue
        if (!isset($erreur))
        {
            // Vérifier et formater le nom du fichier
            $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            // On déplace l'image uploadée du dossier temporaire vers le dossier img-content à la racine du site
            move_uploaded_file($_FILES[$image]['tmp_name'], $dossier . $fichier);
        } else {
            echo $erreur;
        }
        return $fichier;
    }

    public function getMagazines()
    {
        $row = $this->qb
            ->table('magazines')
            ->select([
                'magazines.id',
                'magazines.title',
                'magazines.synopsis',
                'magazines.image',
                'magazines.link',
                'magazines.date',
                'location.location'
            ])
            ->join('location', 'inner')
            ->on('location.id', 'magazines.location_id')
            ->getAll();
        return $row;
    }

    public function getMagazine($id)
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
            ->where('magazines.id', $id)
            ->get();
        return $row;
    }

    public function setMagazines($localisation, $localisation_secondaire)
    {
        if ($_FILES['image']['tmp_name'] != '') {
            $fichier = $this->upload('image');
        } else {
            $fichier = $_POST['lastimage'];
        }

        if ($_FILES['secondary_image']['tmp_name'] != '') {
            $secondary_image = $this->upload('secondary_image');
        } else {
            $secondary_image = $_POST['lastimage_secondary'];
        }

        $this->qb
            ->updateColumns(array(
                'title',
                'synopsis',
                'image',
                "secondary_image",
                'link',
                'date',
                'location_id',
                'secondary_location'))
            ->values(array(
                $_POST['title'],
                $_POST['synopsis'],
                $fichier,
                $secondary_image,
                $_POST['link'],
                $_POST['date'],
                $localisation,
                $localisation_secondaire))
            ->where('id', $_POST['id'])
            ->table('magazines')
            ->update();
        header('Location: /admin/'.$_POST['id'].'/edit');
    }

    public function deleteMagazine($id)
    {
        $this->qb->where('id', $id)->table('magazines')->delete();
        header('Location: /admin');
    }

    public function getPartners($id, $secondary)
    {
        $row = $this->qb
            ->select(array('id', 'name'))
            ->table('partenaires')
            ->where('location_id', $id)
            ->where('location_id', $secondary, ' OR ')
            ->get();
        return $row;
    }

    public function getActualPartners($id)
    {
        $row = $this->qb
            ->select(array('partenaires.id', 'partenaires.name'), array('partner_id', 'partner_name'))
            ->table('partenaires')
            ->join('partenariat', 'inner')
            ->on('partenaires.id', 'partenariat.partenaire_id')
            ->where('partenariat.magazine_id', $id)
            ->get();
        return $row;
    }

    public function addMagazine($localisation, $localisation_secondaire)
    {
        $fichier = $this->upload('image'); // Upload first image, returns path (example.jpg)

        if ($_FILES['image_secondaire']['tmp_name'] != '') {
            $secondary_image = $this->upload('image_secondaire');
        } else {
            $secondary_image = '';
        }

        $this->qb
            ->addColumns(array(
                'title',
                'synopsis',
                'image',
                'secondary_image',
                'link',
                'date',
                'location_id',
                'secondary_location'
                ))
            ->values(array(
                $_POST['title'],
                $_POST['synopsis'],
                $fichier,
                $secondary_image,
                $_POST['link'],
                $_POST['date'],
                $localisation,
                $localisation_secondaire))
            ->table('magazines')
            ->add();
        header('Location: /admin/'.$this->qb->db->lastInsertId().'/edit');
    }

    public function getLocId($localisation)
    {
        $row = $this->qb
            ->select(array('id'))
            ->table('location')
            ->where('location', $localisation)
            ->get();
        return $row;
    }

    public function addLocation($localisation)
    {
        $this->qb
            ->addColumns(array('location'))
            ->table('location')
            ->values(array($localisation))
            ->add();
        return $this->qb->db->lastInsertId();
    }

    public function getMessages()
    {
        $row = $this->qb
            ->select(array(
                'id',
                'raison_sociale',
                'nom',
                'telephone',
                'mail',
                'service',
                'message',
                'object',
                'date'))
            ->table('contact')
            ->orderBy('date', 'DESC')
            ->getAll();
        return $row;
    }

    public function getMessage($id)
    {
        $row = $this->qb
            ->select(array(
                'id',
                'raison_sociale',
                'nom',
                'telephone',
                'mail',
                'service',
                'message',
                'object',
                'date'))
            ->table('contact')
            ->where('id', $id)
            ->get();
        return $row;
    }

    public function getActu()
    {
        $row = $this->qb
            ->select(array(
                'id',
                'title',
                'slug',
                'content_short',
                'content_full',
                'date'))
            ->table('actualites')
            ->getAll();
        return $row;
    }

    public function getActuSingle($id)
    {
        $row = $this->qb
            ->select(array(
                'id',
                'title',
                'slug',
                'content_short',
                'content_full',
                'date'))
            ->table('actualites')
            ->where('id', $id)
            ->get();
        return $row;
    }

    public function getAllPartners()
    {
        $row = $this->qb
            ->select([
                'partenaires.id',
                'partenaires.name',
                'partenaires.link',
                'partenaires.location_id',
                'partenaires.visible_front',
                'location.location'
            ])
            ->table('partenaires')
            ->join('location', 'inner')
            ->on('location.id', 'partenaires.location_id')
            ->getAll();
        return $row;
    }

    public function setVisible($id)
    {
        $this->qb
            ->updateColumns(['visible_front'])
            ->values([0])
            ->table('partenaires')
            ->where('visible_front', 1)
            ->update();

        $this->qb
            ->updateColumns(['visible_front'])
            ->values([1])
            ->where('id', $id)
            ->table('partenaires')
            ->update();

        header('Location: /admin/partenaires');
    }

    public function deletePartner($id)
    {
        $this->qb
            ->table('partenaires')
            ->where('id', $id)
            ->delete();
        header('Location: /admin/partenaires');
    }

    public function getPartner($id)
    {
        $row = $this->qb
            ->select([
                'partenaires.id',
                'partenaires.name',
                'partenaires.link',
                'partenaires.location_id',
                'partenaires.visible_front',
                'location.location'
            ])
            ->table('partenaires')
            ->join('location', 'inner')
            ->on('location.id', 'partenaires.location_id')
            ->where('partenaires.id', $id)
            ->get();
        return $row;
    }

    public function updatePartner($id, $localisation)
    {
        $this->qb
            ->updateColumns(array(
                'name',
                'link',
                'location_id',
            ))
            ->values(array(
                $_POST['nom'],
                $_POST['link'],
                $localisation))
            ->where('id', $id)
            ->table('partenaires')
            ->update();
        header('Location: /admin/partenaires/'.$id);
    }

    public function getCommandes()
    {
        $row = $this->qb
            ->table('commande')
            ->select(array(
                'commande.id',
                'commande.raison_sociale',
                'commande.activite',
                'commande.nom',
                'commande.prenom',
                'commande.fonction',
                'commande.adresse',
                'commande.code_postal',
                'commande.ville',
                'commande.pays',
                'commande.telephone',
                'commande.fax',
                'commande.mail',
                'commande.zone_geographique',
                'commande.revue',
                'commande.quantite',
                'commande.commande_id',
                'commande.date_add AS date',
                'type_commande.type'))
            ->join('type_commande', 'inner')
            ->on('type_commande.id', 'commande.commande_id')
            ->orderBy('commande.date_add', 'DESC')
            ->getAll();
        return $row;
    }

    public function getCommande($id)
    {
        $row = $this->qb
            ->select([
                'id',
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
                'date_add'
            ])
            ->table('commande')
            ->where('id', $id)
            ->get();
        return $row;
    }
}
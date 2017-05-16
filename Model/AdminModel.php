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

    private function upload()
    {
        // Définition du dossier de destination
        $dossier = 'assets/img-content/';
// Définition du nom du fichier uploadé dans la variable fichier
        $fichier = basename($_FILES['image']['name']);
// Création de la variable pour la taille max en octets
        $taille_maxi = 100000;
// Evaluation de la taille du fichier uploadé
        $taille_fichier = filesize($_FILES['image']['tmp_name']);
// On définie les extensions autorisée par le système (images)
        $extensions_ok = array('.png', '.jpg', '.jpeg');
// On va chercher l'extension du fichier uploadé dans edit-form.php
        $extension_fichier = strrchr($_FILES['image']['name'], '.');
        if($taille_fichier > $taille_maxi)
        {
            // Variable erreur avec le message à afficher en cas d'erreur
            $erreur = "Le fichier est trop lourd";
        }
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
            move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);
        } else {
            echo $erreur;
        }
        return $fichier;
    }

    public function getMagazines()
    {
        $row = $this->qb->table('magazines')->select(array('id', 'title'))->getAll();
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

    public function setMagazines()
    {
        if ($_FILES['image']['tmp_name'] != '') {
            $fichier = $this->upload();
        } else {
            $fichier = $_POST['lastimage'];
        }
        $this->qb->updateColumns(array('title', 'synopsis', 'image', 'link', 'date'))->values(array($_POST['title'], $_POST['synopsis'], $fichier, $_POST['link'], $_POST['date']))->where('id', $_POST['id'])->table('magazines')->update();
        header('Location: /admin');
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

    public function addMagazine()
    {
        $fichier = $this->upload(); // Upload first image, returns path (example.jpg)

        $this->qb
            ->addColumns(array(
                'title',
                'synopsis',
                'image',
                'link',
                'date',
                'secondary_image',
                'secondary_location',
                'location_id'
                ))
            ->values(array(
                $_POST['title'],
                $_POST['synopsis'],
                $fichier,
                $_POST['link'],
                $_POST['date']))
            ->table('magazines')
            ->add();
        header('Location: /admin');
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
}
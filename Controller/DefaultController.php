<?php

namespace Controller;

use classes\Controller;
use classes\QueryBuilder;

class DefaultController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fooAction()
    {
        echo "salut";
    }

    public function chickAction()
    {
        echo "wouw";
    }

    public function contactAction()
    {
        echo 'on est sur la page contact';
    }

    public function testAction($id, $test)
    {
        echo 'je suis l\'article '.$id . ' et je suis ' . $test;
//       echo  self::$twig[0]->render(
//           "home.html.twig",
//           [
//               "prenom" => $test,
//               "age"    => $id
//           ]
//       );
//        $qb = new QueryBuilder();
//        $qb->updateColumns(array('nom', 'degats'))->values(array('mate', 2))->where('id', '2')->table('personnages')->update();
//        $qb->table('personnages')->where('id', 3)->delete();
//        $test = $qb->table('cours')->select(array("cours.name", "tags.name"), array('', 'tag'))->join('tags', 'inner')->on('cours.tag_id', 'tags.id')->where('tags.name', 'medicament')->get();
//        var_dump($test);
    }
}
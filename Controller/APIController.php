<?php
/**
 * Created by PhpStorm.
 * User: antoinemasselot
 * Date: 18/05/2017
 * Time: 00:27
 */

namespace Controller;


use classes\Controller;
use Model\APIModel;

class APIController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new APIModel();
    }

    public function getMagazinesFromLocationAction($location)
    {
        $location = implode(' ', explode('_', $location));
        $magazines = $this->model->getMagazines($location);
        echo json_encode($magazines);
    }
}
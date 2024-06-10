<?php

namespace controllers;

use core\Controller;
use core\Model;
use core\Template;
use models\Users;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render();
    }
}
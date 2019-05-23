<?php
namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller {
    protected function setMeta($title = null, $keywords = null, $description = null) {
        $this->view->title = $title;
        $this->view->registerMetatag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetatag(['name' => 'description', 'content' => "$description"]);
    }

   
}
<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Specialization;


class SpecializationController extends Controller
{
    public function actionIndex()
    {
        $specialization = Specialization::find()->one();
        if ($specialization) {
            echo($specialization->name);
        }
        
    }

}

<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Console controller with different utils.
 */
class UtilsController extends Controller
{
    /**
     * Generates UUID and shows it.
     * @return void
     */
    public function actionUuid()
    {
        echo uuid() . "\n";
    }
}

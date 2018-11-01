<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 07.06.18
 * Time: 13:43
 */

namespace tina\news\controllers\frontend;

use krok\system\components\frontend\Controller;
use tina\news\models\News;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 *
 * @package tina\news\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $list = News::find()->list()->order()->hidden()->all();

        return $this->render('index', [
            'list' => $list,
        ]);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = News::find()->byId($id);

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

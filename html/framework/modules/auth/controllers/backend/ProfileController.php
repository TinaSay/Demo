<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 19.07.17
 * Time: 18:22
 */

namespace app\modules\auth\controllers\backend;

use app\modules\auth\models\Auth;
use app\modules\auth\models\Profile;
use krok\system\components\backend\Controller;
use Yii;

/**
 * Class ProfileController
 *
 * @package app\modules\auth\controllers\backend
 */
class ProfileController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $profile = new Profile();

        if ($profile->load(Yii::$app->getRequest()->post()) && $profile->validate()) {

            $model = $this->findModel();
            $model->password = $profile->passwordNew;

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Пароль успешно изменен');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ошибка изменения пароля');
            }
        }

        return $this->render('index', ['profile' => $profile]);
    }

    /**
     * @return null|\yii\web\IdentityInterface|Auth
     */
    protected function findModel()
    {
        return Yii::$app->getUser()->getIdentity();
    }
}

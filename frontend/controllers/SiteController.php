<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\ValidUsers;

use yii\db\Expression;

use common\models\Start;
use common\models\Services;
use common\models\Portfolio;
use common\models\AboutUs;
use common\models\Team;
use common\models\Clients;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        global $dataPortfolio;

        $data = array();

        $data['ModelStart']     = Start::find()->where(['Status' => 1])->all();
        $data['ModelServices']  = Services::find()->all();
        $data['ModelPortfolio'] = Portfolio::find()->all();
        $data['ModelAboutUs']   = AboutUs::find()->all();
        $data['ModelTeam']      = Team::find()->all();
        $data['ModelClients']   = Clients::find()->all();

        $dataPortfolio = $data['ModelPortfolio'];

        return $this->render('index',$data);
    }
}
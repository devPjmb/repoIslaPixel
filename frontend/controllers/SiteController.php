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
use common\models\Contact;
use common\models\Seo;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        global $dataPortfolio, $dataStart, $dataContact, $dataSeo;

        $data = array();

        $_temp = Clients::find()->all();
        shuffle($_temp);

        $data['ModelStart']     = Start::find()->where(['Status' => 1])->all();
        $data['ModelServices']  = Services::find()->all();
        $data['ModelPortfolio'] = Portfolio::find()->all();
        $data['ModelAboutUs']   = AboutUs::find()->all();
        $data['ModelTeam']      = Team::find()->all();
        $data['ModelClients']   = $_temp;
        $data['ModelContact']   = Contact::find()->where(['Status' => 1])->all();
        $data['ModelSEO']       = Seo::find()->all();

        $dataPortfolio   = $data['ModelPortfolio'];
        $dataStart       = $data['ModelStart'];
        $dataContact     = $data['ModelContact'];
        $dataSeo         = $data['ModelSEO'];

        return $this->render('index',$data);
    }
}
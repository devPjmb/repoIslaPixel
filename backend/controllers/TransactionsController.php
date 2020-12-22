<?php  

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\components\ValidUsers;

use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\data\ActiveDataProvider;

class TransactionsController extends Controller
{
	private $_ValidUser;

	public function actionBlocks()
	{

		$this->_ValidUser = new ValidUsers;
		$this->_ValidUser->AccesControl([1]);

		$user_data = Yii::$app->session->get('UserData');
		$this->layout = $user_data['LayoutUser'];

		$Data = array();

		return $this->render('blocks',$Data);
	}
}
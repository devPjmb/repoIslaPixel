<?php  

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\components\ValidUsers;

use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use backend\models\executivepromotions\ExecutivePromotion;

use yii\data\ActiveDataProvider;

class ExecutivepromotionsController extends Controller
{

	private $_ValidUser;
	
	public function actionIndex()
	{

		$this->_ValidUser = new ValidUsers;
		$this->_ValidUser->AccesControl([1]);

		$user_data = Yii::$app->session->get('UserData');
		$this->layout = $user_data['LayoutUser'];

		$Data = array();

		$Data['ModelExecutivePromotion']  = $ModelExecutivePromotion = ExecutivePromotion::find();
		$Data['executivepromotionProvider']  = new ActiveDataProvider([
		    'query' => $ModelExecutivePromotion,
		    'pagination' => [
		        'pageSize' => 20,
		    ],
		]);

		return $this->render('index',$Data);

	}

	public function actionPromotion () {

		date_default_timezone_set("America/Guatemala");

		$this->_ValidUser = new ValidUsers;
		$this->_ValidUser->AccesControl([1]);

		$id = (isset($_GET["id"]))?$_GET["id"]:NULL;

		if (empty($id)) {
			$ExecutivePromotion = new ExecutivePromotion();
		} else {
			$ExecutivePromotion = ExecutivePromotion::findOne($id);
		}

		if ($ExecutivePromotion->load(Yii::$app->request->post())) {

			if ($ExecutivePromotion->validate()) {

				$transaction = \Yii::$app->db->beginTransaction();

				try {

					$ExecutivePromotion->save();

					$transaction->commit();
					Yii::$app->session->setFlash('success', "Promocion guardada correctamente.");
					$this->redirect(['/executivepromotions']);

				} catch (Exception $e) {
					$transaction->rollBack();
					Yii::$app->session->setFlash('error', "Problema con el servidor.");
				}

			} else {
				Yii::$app->session->setFlash('error', "Problema con algún dato.");
			}

		}

		$user_data = Yii::$app->session->get('UserData');
		$this->layout = $user_data['LayoutUser'];

		$Data = array();
		$Data['ExecutivePromotion'] = $ExecutivePromotion;

		return $this->render('promotion',$Data);

	}

	public function actionDeletepromotion ($id) {

		$this->_ValidUser = new ValidUsers;
		$this->_ValidUser->AccesControl([1]);
		$this->layout = false;

		$Promotion = Promotion::findOne($id);
		$transaction = \Yii::$app->db->beginTransaction();

		try {
			$Promotion->delete();
			$transaction->commit();
			Yii::$app->session->setFlash('success', "Promocion eliminada correctamente.");
			$this->redirect(['/promotions']);
		} catch (Exception $e) {
			$transaction->rollBack();
			$this->redirect(['/promotions']);
		}

	}

	public function actionNotifications () {

		date_default_timezone_set("America/Guatemala");

		$this->_ValidUser = new ValidUsers;
		$this->_ValidUser->AccesControl([1]);

		$user_data = Yii::$app->session->get('UserData');
		$this->layout = $user_data['LayoutUser'];

		$Data = array();

		return $this->render('notifications',$Data);


	}

	public function actionGetpromotions () {

		$this->_ValidUser = new ValidUsers;
		$this->_ValidUser->AccesControl([1]);

	}

	// public function actionGoals () {

	// 	date_default_timezone_set("America/Guatemala");

	// 	$this->_ValidUser = new ValidUsers;
	// 	$this->_ValidUser->AccesControl([1]);

	// 	$user_data = Yii::$app->session->get('UserData');
	// 	$this->layout = $user_data['LayoutUser'];

	// 	$Data = array();

	// 	$Data['pGoalsQuery'] = $pGoalsQuery = pGoal::find();
	// 	$Data['cGoalsQuery'] = $cGoalsQuery = cGoal::find();

	// 	$Data['pGoalsProvider']  = new ActiveDataProvider([
	// 	    'query' => $pGoalsQuery,
	// 	    'pagination' => [
	// 	        'pageSize' => 5,
	// 	    ],
	// 	]);

	// 	$Data['cGoalsProvider']  = new ActiveDataProvider([
	// 	    'query' => $cGoalsQuery,
	// 	    'pagination' => [
	// 	        'pageSize' => 5,
	// 	    ],
	// 	]);

	// 	return $this->render('goals',$Data);

	// }

	// public function actionCgoal () {

	// 	date_default_timezone_set("America/Guatemala");

	// 	$this->_ValidUser = new ValidUsers;
	// 	$this->_ValidUser->AccesControl([1]);

	// 	$user_data = Yii::$app->session->get('UserData');
	// 	$this->layout = $user_data['LayoutUser'];

	// 	$id = (isset($_GET["id"]))?$_GET["id"]:NULL;

	// 	if (empty($id)) {
	// 		$cGoal = new cGoal;
	// 	} else {
	// 		$cGoal = cGoal::findOne($id);
	// 	}

	// 	if ($cGoal->load(Yii::$app->request->post())) {
	// 		if ($cGoal->validate()) {
	// 			if ($cGoal->save(false)) {
	// 				Yii::$app->session->setFlash('success', "Meta guardada exitosamente.");
	// 				return $this->redirect(['/promotions/goals']);
	// 			} else {
	// 				Yii::$app->session->setFlash('error', "Error con el servidor.");
	// 			}
	// 		} else {
	// 			Yii::$app->session->setFlash('error', "Problema con algún dato.");
	// 		}
	// 	}

	// 	$Data = array();
	// 	$Data['cGoal'] = $cGoal;

	// 	return $this->render('cgoal',$Data);

	// }

	// public function actionDeletecgoal ($id) {

	// 	$this->_ValidUser = new ValidUsers;
	// 	$this->_ValidUser->AccesControl([1]);
	// 	$this->layout = false;

	// 	$cGoal = cGoal::findOne($id);
	// 	if (isset($cGoal)) {
	// 		if ($cGoal->delete()) {
	// 			Yii::$app->session->setFlash('success', "Meta eliminada exitosamente.");
	// 			return $this->redirect(['/promotions/goals']);
	// 		} else {
	// 			Yii::$app->session->setFlash('error', "Error de servidor.");
	// 			return $this->redirect(['/promotions/goals']);
	// 		}
	// 	} else {
	// 		Yii::$app->session->setFlash('error', "Meta no conseguida.");
	// 		return $this->redirect(['/promotions/goals']);
	// 	}

	// }

	// public function actionPgoal () {

	// 	date_default_timezone_set("America/Guatemala");

	// 	$this->_ValidUser = new ValidUsers;
	// 	$this->_ValidUser->AccesControl([1]);

	// 	$user_data = Yii::$app->session->get('UserData');
	// 	$this->layout = $user_data['LayoutUser'];

	// 	$id = (isset($_GET["id"]))?$_GET["id"]:NULL;

	// 	if (empty($id)) {
	// 		$pGoal = new pGoal;
	// 	} else {
	// 		$pGoal = pGoal::findOne($id);
	// 	}

	// 	if ($pGoal->load(Yii::$app->request->post())) {
	// 		if ($pGoal->validate()) {
	// 			if ($pGoal->save(false)) {
	// 				Yii::$app->session->setFlash('success', "Meta guardada exitosamente.");
	// 				return $this->redirect(['/promotions/goals']);
	// 			} else {
	// 				Yii::$app->session->setFlash('error', "Error con el servidor.");
	// 			}
	// 		} else {
	// 			Yii::$app->session->setFlash('error', "Problema con algun dato.");
	// 		}
	// 	}

	// 	$Data = array();
	// 	$Data['pGoal'] = $pGoal;
		
	// 	return $this->render('pgoal',$Data);

	// }

	// public function actionDeletepgoal ($id) {

	// }

	// public function actionGetcode () {

	// 	header("Content-type:application/json");

	// 	$this->_ValidUser = new ValidUsers;
	// 	$this->_ValidUser->AccesControl([1]);

	// 	$Code = substr(md5(rand()),0,5);

	// 	$Promotion = Promotion::find()->where('Code = :Code',[':Code'=>$Code])->one();

	// 	while (!empty($Promotion)) {
	// 		$Code = substr(md5(rand()),0,5);
	// 		$Promotion = Promotion::find()->where('Code = :Code',[':Code'=>$Code])->one();
	// 	}

	// 	$Response = array();
	// 	$Response['Code'] = $Code;

	// 	echo json_encode($Response);	

	// }

}

?>
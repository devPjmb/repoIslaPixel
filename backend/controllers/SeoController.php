<?php 
	namespace backend\controllers;

	use Yii;
	use yii\web\Controller;
    use common\components\ValidUsers;

	use yii\filters\VerbFilter;
    use yii\helpers\ArrayHelper;
	use yii\web\NotFoundHttpException;
	use yii\web\Response;

    // use common\models\Menu;
    use common\models\Seo;
    
	use yii\data\ActiveDataProvider;

	class SeoController extends Controller
	{
		private $_ValidUser;

		public function actionIndex(){
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			// 1 = Users Admin
			// 2 = Users moderador
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];

			$ModelSeo = ( (Seo::findOne(1)) != NULL ) ? Seo::findOne(1) : new Seo;

			$post = Yii::$app->request->post();
			
			if($ModelSeo->load($post)){
				if($ModelSeo->validate()){
					if($ModelSeo->save()){
						Yii::$app->session->setFlash('success', "Informacion insertada de manera satisfactoria");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la informacion");
					}
				}else{
					Yii::$app->session->setFlash('error', "Error al validar los datos. Revise los datos y vuelva a intentar.");
				}
				return $this->redirect(['/seo']);
			}
			$data['ModelSeo'] = $ModelSeo;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Seo::validate($ModelSeo)
                );
            }

			return $this->render('index',$data);
		}
	}
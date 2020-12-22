<?php 
	namespace backend\controllers;

	use Yii;
	use yii\web\Controller;
	use yii\web\UploadedFile;
    use common\components\ValidUsers;

	use yii\filters\VerbFilter;
    use yii\helpers\ArrayHelper;
	use yii\web\NotFoundHttpException;
	use yii\web\Response;

    // use common\models\Menu;
    use common\models\Start;
    
	use yii\data\ActiveDataProvider;

	class StartController extends Controller
	{
		private $_ValidUser;

		public function actionIndex(){
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			// 1 = Users Admin
			// 2 = Users moderador
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelStart']  = $ModelStartCrud = Start::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelStartCrud,
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);

			$ModelStart = new Start;
			$ModelStartAll = Start::find()->all();

			$post = Yii::$app->request->post();

			if($ModelStart->load($post)){
			$status = $post['Start']['Status'];
				if($ModelStart->validate()){
					if($status == 1){
						foreach ($ModelStartAll as $key => $value) {
							$value->Status = '0';
							$value->save();
						}
					}
					$upload = true;
					$ModelStart->TempImg = UploadedFile::getInstance($ModelStart, 'TempImg');
					if($ModelStart->TempImg !== false){
						$upload = $ModelStart->upload();
					}
					if($upload){
						if($ModelStart->save()){
							Yii::$app->session->setFlash('success', "Imagen insertada de manera satisfactoria");
						}else{
							Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la imagen");
						}
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
					}
				}else{
					Yii::$app->session->setFlash('error', "Error insertanto la imagen. Revise los datos");
				}
				return $this->redirect(['/start']);
			}
			$data['ModelStart'] = $ModelStart;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Start::validate($ModelStart)
                );
            }

			return $this->render('index',$data);
		}

		public function actionEnable($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$data = [];
			$this->layout = false;
			$ModelStart = Start::findOne($id);
			$ModelStartAll = Start::find()->all();
			foreach ($ModelStartAll as $key => $value) {
				$value->Status = '0';
				$value->save();
			}
			$ModelStart->Status = '1';
			if($ModelStart->save()){
				Yii::$app->session->setFlash('success', "Imagen activada");
			}else{
				Yii::$app->session->setFlash('error', "Error");
			}
			return $this->redirect(['/start']);
		}

		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelStart = Start::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/start/'.$ModelStart->ImgBackground);
				if($deleteFile){
					if($ModelStart->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/start']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/start']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/start']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/start']);
			}
		}
	}
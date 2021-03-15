<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use yii\web\UploadedFile;

    use common\models\Services;
    use common\components\ValidUsers;

    use yii\data\ActiveDataProvider;

    /**
     * Services controller 
     */
    class ServicesController extends Controller
    {
        private $_ValidUser;

		public function actionIndex($id = null){
            $this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelServices']  = $ModelServicesCRUD = Services::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelServicesCRUD,
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);

			return $this->render('index',$data);
        }
        
        public function actionCreate($id=null)
        {
        	$this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			
			$post = Yii::$app->request->post();

			$ModelServices = ($id !== null) ? Services::findOne($id) :  new Services;

			if($ModelServices->load($post)){
				$upload = true;
				$ModelServices->TempImg = UploadedFile::getInstance($ModelServices, 'TempImg');
				if($ModelServices->TempImg)
					$upload = $ModelServices->upload();
				if($upload){
					if($ModelServices->save()){
						Yii::$app->session->setFlash('success', "Imagen insertada de manera satisfactoria");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la imagen");
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
				}
				return $this->redirect(['/services']);
			}

			$data['ModelServices'] = $ModelServices;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Services::validate($ModelServices)
                );
            }

            return $this->render('create',$data);
        }

		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelServices = Services::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/services/'.$ModelServices->ServiceImg);
				if($deleteFile){
					if($ModelServices->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/services']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/services']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/services']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/services']);
			}
		}
    }
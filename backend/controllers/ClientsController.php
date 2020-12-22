<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use yii\web\UploadedFile;

    use common\models\Clients;
    use common\components\ValidUsers;

    use yii\data\ActiveDataProvider;

    /**
     * Clients controller 
     */
    class ClientsController extends Controller
    {
        private $_ValidUser;

		public function actionIndex($id = null){
            $this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelClients']  = $ModelClientsCRUD = Clients::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelClientsCRUD,
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);

			return $this->render('index',$data);
        }

        public function actionCreate($id=null)
        {
        	$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			// 1 = Users Admin
			// 2 = Users moderador
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];

			if ($id !== NULL) {
				$ModelClients = Clients::findOne($id);
			}else{
				$ModelClients = new Clients;
			}
			$post = Yii::$app->request->post();

			if($ModelClients->load($post)){
				$upload = true;
				$ModelClients->TempImg = UploadedFile::getInstance($ModelClients, 'TempImg');
				if($ModelClients->TempImg !== null){
					$upload = $ModelClients->upload();
				}
				if($upload){
					if($ModelClients->save()){
						Yii::$app->session->setFlash('success', "Imagen insertada de manera satisfactoria");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la imagen");
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
				}
				return $this->redirect(['/clients']);
			}

			$data['ModelClients'] = $ModelClients;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Clients::validate($ModelClients)
                );
            }
        return $this->render('create',$data);
        }
        
		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelClients = Clients::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/clients/'.$ModelClients->ClientImg);
				if($deleteFile){
					if($ModelClients->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/clients']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/clients']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/clients']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/clients']);
			}
		}
    }
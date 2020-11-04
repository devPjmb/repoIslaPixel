<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use yii\web\UploadedFile;

    use common\models\AboutUs;
    use common\components\ValidUsers;

    use yii\data\ActiveDataProvider;

    /**
     * Aboutus controller 
     */
    class AboutusController extends Controller
    {
        private $_ValidUser;

		public function actionIndex($id = null){
            $this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelAboutUs']  = $ModelAboutUsCRUD = AboutUs::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelAboutUsCRUD,
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
				$ModelAboutUs = AboutUs::findOne($id);
			}else{
				$ModelAboutUs = new AboutUs;
			}
			$post = Yii::$app->request->post();

			if($ModelAboutUs->load($post)){
				$upload = true;
				$ModelAboutUs->TempImg = UploadedFile::getInstance($ModelAboutUs, 'TempImg');
				if($ModelAboutUs->TempImg !== null){
					$upload = $ModelAboutUs->upload();
				}
				if($upload){
					if($ModelAboutUs->save()){
						Yii::$app->session->setFlash('success', "Imagen insertada de manera satisfactoria");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la imagen");
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
				}
				return $this->redirect(['/aboutus']);
			}

			$data['ModelAboutUs'] = $ModelAboutUs;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    AboutUs::validate($ModelAboutUs)
                );
            }
        return $this->render('create',$data);
        }
        
		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelAboutUs = AboutUs::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/about/'.$ModelAboutUs->Image);
				if($deleteFile){
					if($ModelAboutUs->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/aboutus']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/aboutus']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/aboutus']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/aboutus']);
			}
		}
    }
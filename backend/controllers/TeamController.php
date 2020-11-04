<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use yii\web\UploadedFile;

    use common\models\Team;
    use common\components\ValidUsers;

    use yii\data\ActiveDataProvider;

    /**
     * Team controller 
     */
    class TeamController extends Controller
    {
        private $_ValidUser;

		public function actionIndex($id = null){
            $this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelTeam']  = $ModelTeamCRUD = Team::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelTeamCRUD,
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
				$ModelTeam = Team::findOne($id);
			}else{
				$ModelTeam = new Team;
			}
			$post = Yii::$app->request->post();

			if($ModelTeam->load($post)){
				$upload = true;
				$ModelTeam->TempImg = UploadedFile::getInstance($ModelTeam, 'TempImg');
				if($ModelTeam->TempImg !== null){
					$upload = $ModelTeam->upload();
				}
				if($upload){
					if($ModelTeam->save()){
						Yii::$app->session->setFlash('success', "Imagen insertada de manera satisfactoria");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la imagen");
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
				}
				return $this->redirect(['/team']);
			}

			$data['ModelTeam'] = $ModelTeam;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Team::validate($ModelTeam)
                );
            }
        return $this->render('create',$data);
        }
        
		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelTeam = Team::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/team/'.$ModelTeam->Photo);
				if($deleteFile){
					if($ModelTeam->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/team']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/team']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/team']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/team']);
			}
		}
    }
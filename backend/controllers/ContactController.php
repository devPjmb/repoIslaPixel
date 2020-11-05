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
    use common\models\Contact;
    
	use yii\data\ActiveDataProvider;

	class ContactController extends Controller
	{
		private $_ValidUser;

		public function actionIndex(){
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			// 1 = Users Admin
			// 2 = Users moderador
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelContact']  = $ModelContactCrud = Contact::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelContactCrud,
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);

			$ModelContact = new Contact;
			$ModelContactAll = Contact::find()->all();

			$post = Yii::$app->request->post();

			if($ModelContact->load($post)){
			$status = $post['Contact']['Status'];
				if($ModelContact->validate()){
					if($status == 1){
						foreach ($ModelContactAll as $key => $value) {
							$value->Status = '0';
							$value->save();
						}
					}
					$upload = true;
					$ModelContact->TempImg = UploadedFile::getInstance($ModelContact, 'TempImg');
					if($ModelContact->TempImg !== false){
						$upload = $ModelContact->upload();
					}
					if($upload){
						if($ModelContact->save()){
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
				return $this->redirect(['/contact']);
			}
			$data['ModelContact'] = $ModelContact;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Contact::validate($ModelContact)
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
			$ModelContact = Contact::findOne($id);
			$ModelContactAll = Contact::find()->all();
			foreach ($ModelContactAll as $key => $value) {
				$value->Status = '0';
				$value->save();
			}
			$ModelContact->Status = '1';
			if($ModelContact->save()){
				Yii::$app->session->setFlash('success', "Imagen activada");
			}else{
				Yii::$app->session->setFlash('error', "Error");
			}
			return $this->redirect(['/contact']);
		}

		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelContact = Contact::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/contact/'.$ModelContact->imgBackground);
				if($deleteFile){
					if($ModelContact->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/contact']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/contact']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/contact']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/contact']);
			}
		}
	}
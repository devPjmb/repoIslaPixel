<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use yii\web\UploadedFile;

    use common\models\Portfolio;
    use common\components\ValidUsers;

    use yii\data\ActiveDataProvider;

    /**
     * Portfolio controller 
     */
    class PortfolioController extends Controller
    {
        private $_ValidUser;

		public function actionIndex(){
            $this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelPortfolio']  = $ModelPortfolioCRUD = Portfolio::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelPortfolioCRUD,
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
				$ModelPortfolio = Portfolio::findOne($id);
			}else{
				$ModelPortfolio = new Portfolio;
			}
			$post = Yii::$app->request->post();

			if($ModelPortfolio->load($post)){
				$upload = true;
				$ModelPortfolio->TempImg = UploadedFile::getInstance($ModelPortfolio, 'TempImg');
				if($ModelPortfolio->TempImg !== null){
					$upload = $ModelPortfolio->upload();
				}
				if($upload){
					if($ModelPortfolio->save()){
						Yii::$app->session->setFlash('success', "Imagen insertada de manera satisfactoria");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar la imagen");
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
				}
				return $this->redirect(['/portfolio']);
			}

			$data['ModelPortfolio'] = $ModelPortfolio;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Portfolio::validate($ModelPortfolio)
                );
            }
        return $this->render('create',$data);
        }
        
		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelPortfolio = Portfolio::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/portfolio/'.$ModelPortfolio->ProjectImg);
				$deleteThumb = unlink(Yii::$app->basePath.'/../img/portfolio/'.$ModelPortfolio->ProjectImgThumbnail);
				if($deleteFile && $deleteThumb){
					if($ModelPortfolio->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Imagen eliminada de manera satisfactoria.");
					$this->redirect(['/portfolio']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando la imagen.");
						$transaction->rollBack();
						$this->redirect(['/portfolio']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/portfolio']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar la imagen.");
				$transaction->rollBack();
				$this->redirect(['/portfolio']);
			}
		}
    }
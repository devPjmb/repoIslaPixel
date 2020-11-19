<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use yii\web\UploadedFile;

    use common\models\Blog;
    use common\components\ValidUsers;

    use yii\data\ActiveDataProvider;

    /**
     * Blog controller 
     */
    class BlogController extends Controller
    {
        private $_ValidUser;

		public function actionIndex($id = null){
            $this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];
			$data['ModelBlog']  = $ModelBlogCRUD = Blog::find();

			$data['dataProvider']  = new ActiveDataProvider([
				    'query' => $ModelBlogCRUD,
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);

			return $this->render('index',$data);
        }
        
        public function actionPost($id=null)
        {
        	$this->_ValidUser = new ValidUsers;
            // 1 = Users Admin
			// 2 = Users moderador
			$this->_ValidUser->AccesControl([1, 2]);
			$data = Yii::$app->session->get('UserData');
			$this->layout = $data['LayoutUser'];

			/////////////////Importante para el funcionamiento de///////////////////////
			/////////////////kcfinder y CKeditor carga de archivos//////////////////////
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url=$protocol.$_SERVER['HTTP_HOST'].Yii::getAlias('@proyect');
				 $configkcfinder = fopen(Yii::getAlias('@webroot').'/settingkcfinder.txt', 'w');
				 $uploadURL = $url."/img/blog/";
				 $uploadDir = Yii::getAlias('@webroot')."/../img/blog/";
				 $datafile = json_encode(array('uploadURL' =>  $uploadURL,'uploadDir' => $uploadDir));
				 fwrite($configkcfinder,$datafile);
				 fclose($configkcfinder);
			 ///////////////////////////////////////////////////////////////////////////////
			
			$post = Yii::$app->request->post();

			$ModelBlog = ($id !== null) ? Blog::findOne($id) :  new Blog;

			if($ModelBlog->load($post)){
				$ModelBlog->SeoUrl = str_replace(' ', '_', strtolower($post['Blog']['Title']));
				$upload = true;
				$ModelBlog->TempImg = UploadedFile::getInstance($ModelBlog, 'TempImg');
				if($ModelBlog->TempImg)
					$upload = $ModelBlog->upload();
				if($upload){
					if($ModelBlog->save()){
						Yii::$app->session->setFlash('success', "Post agregado con exito!");
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error al momento de insertar el post");
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al subir la imagen");
				}
				return $this->redirect(['/blog']);
			}

			$data['ModelBlog'] = $ModelBlog;

			if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    Blog::validate($ModelBlog)
                );
            }

            return $this->render('post',$data);
        }

		public function actionDelete($id)
		{
			$this->_ValidUser = new ValidUsers;
			$this->_ValidUser->AccesControl([1]);
			$this->layout = false;
			$ModelBlog = Blog::findOne($id);
			$transaction = \Yii::$app->db->beginTransaction();
			try {
				$deleteFile = unlink(Yii::$app->basePath.'/../img/blog/'.$ModelBlog->ImageUrl);
				if($deleteFile){
					if($ModelBlog->delete()){
					$transaction->commit();
					Yii::$app->session->setFlash('success', "Post eliminado de manera satisfactoria.");
					$this->redirect(['/blog']);
					}else{
						Yii::$app->session->setFlash('error', "Ocurrio un error eliminando el post.");
						$transaction->rollBack();
						$this->redirect(['/blog']);
					}
				}else{
					Yii::$app->session->setFlash('error', "Ocurrio un error al eliminar la imagen del servidor.");
					$this->redirect(['/blog']);
				}
			} catch (Exception $e) {
				Yii::$app->session->setFlash('error', "Error al eliminar el post.");
				$transaction->rollBack();
				$this->redirect(['/blog']);
			}
		}
    }
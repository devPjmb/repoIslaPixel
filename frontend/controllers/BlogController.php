<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use yii\db\Expression;

use common\components\ValidUsers;
use common\models\Seo;
use common\models\Blog;
use common\models\SeoUrl;

/**
 * Blog controller
 */
global $dataSeo;
class BlogController extends Controller
{
    public function actionIndex($idTitle="")
    {
        $this->layout = 'mainBlog';
        $data = array();

        $data['ModelSEO'] = $dataSeo = Seo::find()->all();

        $data['ModelBlog'] = Blog::find()->all();

        $data['dataProvider'] = new ActiveDataProvider([
		    'query' => Blog::find(),
		    'pagination' => [
		    	'pageSize' => 1
		    ],
		]);

        return $this->render('index',$data);
    }

    public function actionPost($id){
        $this->layout = 'mainBlog';
        
        $data = array();

        $data['ModelSEO'] = $dataSeo = Seo::find()->all();

        $data['ModelBlog'] = Blog::findOne($id);

        return $this->render('post', $data);
    }
}
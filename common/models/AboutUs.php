<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class AboutUs extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%AboutUs}}';
    }

    public function rules()
    {
        return [
            [
                ['Year','Title', 'Description', 'Image'], 
                'string'
            ],
            [
                ['TempImg'], 
                'file', 
                'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg, gif, svg',
            ],

        ];
    }

    public function upload()
    {
        if ($this->validate()){

            $this->Image = $this->TempImg->baseName . "-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;

            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/about/'.$this->Image);

            $this->TempImg = null;

            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

}
?>
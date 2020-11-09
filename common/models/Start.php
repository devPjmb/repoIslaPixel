<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class Start extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%Start}}';
    }

    public function rules()
    {
        return [
            [['Status'], 'boolean'],
            [['ImgBackground'], 'string'],
            [['TempImg'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, svg'],

        ];
    }
     public function upload()
    {
        if ($this->validate()) {
            $this->ImgBackground = str_replace(' ', '_', $this->TempImg->baseName) . "-" . substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;
            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/start/' .$this->ImgBackground );
            $this->TempImg = null;

            return true;
        } else {
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
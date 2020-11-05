<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class Contact extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%Contact}}';
    }

    public function rules()
    {
        return [
            [['Status'], 'boolean'],
            [['imgBackground'], 'string'],
            [['TempImg'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, jpeg, svg'],

        ];
    }
     public function upload()
    {
        if ($this->validate()) {
            $this->imgBackground = $this->TempImg->baseName . "-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;
            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/contact/' .$this->imgBackground );
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
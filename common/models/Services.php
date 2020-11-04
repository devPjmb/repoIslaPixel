<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class Services extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%Services}}';
    }

    public function rules()
    {
        return [
            [['ServiceName','ServiceDescription', 'ServiceImg'], 'string'],
            [['TempImg'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, svg'],

        ];
    }
     public function upload()
    {
        if ($this->validate()) {
            $this->ServiceImg = $this->TempImg->baseName . "-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;
            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/services/' .$this->ServiceImg );
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
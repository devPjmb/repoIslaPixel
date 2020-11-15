<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class Blog extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%Blog}}';
    }

    public function rules()
    {
        return [
            [['Title','Content', 'PubDate', 'ImageUrl'], 'string'],
            [['TempImg'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, svg, jpeg, webp'],

        ];
    }
     public function upload()
    {
        if ($this->validate()) {
            $this->ImageUrl = str_replace(' ', '_', $this->TempImg->baseName) . "-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;
            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/blog/' .$this->ImageUrl );
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
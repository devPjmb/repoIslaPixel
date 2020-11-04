<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class Clients extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%Clients}}';
    }

    public function rules()
    {
        return [
            [
                ['ClientName','ClientImg'], 
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

            $this->ClientImg = $this->TempImg->baseName . "-". substr(md5(uniqid(rand())),0,6) . '.' . $this->TempImg->extension;

            $this->TempImg->saveAs(Yii::$app->basePath.'/../img/clients/'.$this->ClientImg);

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
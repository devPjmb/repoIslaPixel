<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use common\models\SeoUrl;

class Tags extends ActiveRecord 
{
    public static function tableName()
    {
        return '{{%Tags}}';
    }

    public function rules()
    {
        return [
            [['Name'], 'string'],
        ];
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }

}
?>
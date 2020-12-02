<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use common\models\SeoUrl;

class PostByTags extends ActiveRecord 
{
    public static function tableName()
    {
        return '{{%PostByTags}}';
    }

    public function rules()
    {
        return [
            [['TagID','PostID'], 'int'],
        ];
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }

}
?>
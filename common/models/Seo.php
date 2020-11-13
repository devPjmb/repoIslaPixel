<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Seo extends ActiveRecord 
{
    public $TempImg;
    public static function tableName()
    {
        return '{{%SEO}}';
    }

    public function rules()
    {
        return [
            [['metaDescription','metaKeywords'], 'string'],

        ];
    }
}
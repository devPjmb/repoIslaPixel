<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class cGoal extends ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%cGoals}}';
    }

    public function attributeHints() 
    {
        return [
            'Name' => 'Nombre descriptivo de la meta.',
            'Duration' => 'Tiempo límite en el que el usuario podrá cumplir la meta.',
            'Prize' => 'Premio de la meta.',
            'Target' => 'Cantidad de dinero necesario para cumplir la meta.',
        ];
    }

    public function attributeLabels()
    {
        return [
            'Name' => 'Nombre de la Meta',
            'Duration' => 'Tiempo límite',
            'Prize' => 'Premio',
            'Target' => 'Objetivo',
        ];
    }

    public function rules () {
        return [
            [['Name', 'Duration', 'Prize', 'Target'], 'required'],
            [['Duration','Prize','Target'], 'integer', 'min' => 0],
            ['Name','string','max'=>100],
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
	*/
    public function getCGoalsByPromotion()
    {
        return $this->hasMany(cGoalsByPromotion::className(), ['cGoalID' => 'cGoalID']);
    }

}

?>
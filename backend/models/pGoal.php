<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class pGoal extends ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%pGoals}}';
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPGoalsByPromotion()
    {
        return $this->hasMany(pGoalsByPromotion::className(), ['pGoalID' => 'pGoalID']);
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

    

}

?>
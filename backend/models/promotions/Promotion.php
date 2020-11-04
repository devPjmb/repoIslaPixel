<?php

namespace backend\models\promotions;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Promotion extends ActiveRecord
{

    public $cGoalID;
    public $pGoalID;

    public static function tableName()
    {
        return '{{%Promotions}}';
    }

    public function attributeHints() 
    {
        return [
            'Name'=>'Nombre descriptivo de la promoción',
            'Status'=>'Estado de la promoción.',
            'ExpirationDate'=>'Fecha en el que la promoción dejara de ser publicada.',
            'Cost'=>'Consumo objetivo para obtener el bono.',
            'Bonus' => 'Monto del bono que el usuario obtendra al conseguir el objetivo.',
        ];
    }

    public function attributeLabels()
    {
        return [
            'Name'=>'Nombre',
            'Status'=>'Estado',
            'ExpirationDate'=>'Fecha de Expiracion',
            'Cost'=>'Objetivo',
            'Bonus' => 'Bono',
        ];
    }

    public function rules () {
        return [
            [['Name','Cost','Bonus','ExpirationDate'], 'required'],
            [['Name'],'string','max'=>100],
            [['Status','Cost','Bonus'], 'integer', 'min' => 0],
            ['Status','default','value'=>1],
        ];
    }

}
?>
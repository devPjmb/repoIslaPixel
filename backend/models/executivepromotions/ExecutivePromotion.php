<?php

namespace backend\models\executivepromotions;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ExecutivePromotion extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%ExecutivePromotions}}';
    }

    public function attributeHints() 
    {
        return [
            'Name'=>'Nombre descriptivo de la promoción',
            'Status'=>'Estado de la promoción.',
            'Duration'=>'Cantidad de dias en el que la promocion estara activa despues de ser adquirida por el usuario.',
            'Cost'=>'Consumo objetivo para obtener el bono.',
            'Bonus' => 'Monto del bono que el usuario obtendra al conseguir el objetivo.',
        ];
    }

    public function attributeLabels()
    {
        return [
            'Name'=>'Nombre',
            'Status'=>'Estado',
            'Duration'=>'Duracion',
            'Cost'=>'Objetivo',
            'Bonus' => 'Bono',
        ];
    }

    public function rules () {
        return [
            [['Name','Cost','Bonus','Duration'], 'required'],
            [['Name'],'string','max'=>100],
            [['Status','Cost','Bonus','Duration'], 'integer', 'min' => 0],
            ['Status','default','value'=>1],
        ];
    }

}
?>
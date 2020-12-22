<?php  

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class pGoalsByPromotion extends ActiveRecord
{
	
	public static function tableName()
    {
        return '{{%pGoalsByPromotions}}';
    }


    /**
    * @return \yii\db\ActiveQuery
	*/
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['PromotionID' => 'PromotionID']);
    }

    /**
    * @return \yii\db\ActiveQuery
	*/
    public function getPGoal()
    {
        return $this->hasOne(pGoal::className(), ['cGoalID' => 'cGoalID']);
    }

}

?>
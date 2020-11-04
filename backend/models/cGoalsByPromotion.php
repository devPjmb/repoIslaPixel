<?php  

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class cGoalsByPromotion extends ActiveRecord
{
	
	public static function tableName()
    {
        return '{{%cGoalsByPromotions}}';
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
    public function getCGoal()
    {
        return $this->hasOne(cGoal::className(), ['cGoalID' => 'cGoalID']);
    }

}

?>
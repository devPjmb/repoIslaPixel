<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Account extends ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%Account}}';
    }

  /**
 	* @return \yii\db\ActiveQuery
	 */
	public function getUserAccount()
	{
	    return $this->hasOne(UserAccount::className(), ['AccountID' => 'AccountID']);
	}

	/**
 	* @return \yii\db\ActiveQuery
	 */
	public function getAgency()
	{
	    return $this->hasOne(Agency::className(), ['AccountID' => 'AccountID']);
	}




}
?>
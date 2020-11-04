<?php 
	namespace common\models;

	use yii;
	use yii\base\Model;
	use yii\base\NotSupportedException;
	use yii\db\ActiveRecord;
	
	class Agency extends ActiveRecord
	{
		

		public static function tableName()
		{
			return '{{%Agency}}';
		}
		public function rules()
    {
        return [
            [['FirstName','LastName','Country'], 'required'],
            [['FirstName','LastName','CompanyName'], 'string','max' => 32],
            [['Address1','Address2'], 'string','max' => 128],
            [['BusinessPhone','City'], 'string','max' => 16],
            [['State'], 'string','max' => 2],
            [['ZipCode','Extension'], 'string','max' => 8],
            [['CompanyWebSite'], 'string','max' => 256],
            [['Country'],'integer', 'integerOnly'=>true],

        ];
    }

		/**
	 	* @return \yii\db\ActiveQuery
		 */
		public function getAccount()
		{
		    return $this->hasOne(Account::className(), ['AccountID' => 'AccountID']);
		}
	}

?>
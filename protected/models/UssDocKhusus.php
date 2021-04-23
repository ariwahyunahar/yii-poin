<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $id
 * @property string $nik
 * @property string $name
 * @property string $email
 * @property string $born_date
 */
class UssDocKhusus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'uss_doc_khusus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nik', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nik', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nik' => 'nik'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nik',$this->nik);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function anggotaDOkKhusus($nik = '')
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "nik = '$nik'";
		$istrue = self::model()->findAll($criteria);
		return $istrue;
	}
	
	
    public static function anggotaMenuKhusus()
    {
        $q1 = "select * from usr_es where code_in='".md5(Yii::app()->session['usr_id'].'_ariwa')."'";
        $cmd1 = Yii::app()->db->createCommand($q1);
        $is_member = $cmd1->queryAll();

        if($is_member){
            return true;
        }
        return false;

    }
}
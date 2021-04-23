<?php

/**
 * This is the model class for table "polling_choice".
 *
 * The followings are the available columns in table 'polling_choice':
 * @property integer $id
 * @property string $choice
 * @property string $description
 * @property integer $polling_id
 *
 * The followings are the available model relations:
 * @property Polling $polling
 */
class PollingChoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PollingChoice the static model class
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
		return 'polling_choice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('choice', 'required'),
			array('polling_id', 'numerical', 'integerOnly'=>true),
			array('choice', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, choice, description, polling_id', 'safe', 'on'=>'search'),
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
			'polling' => array(self::BELONGS_TO, 'Polling', 'polling_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'choice' => 'Choice',
			'description' => 'Description',
			'polling_id' => 'Polling',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('choice',$this->choice,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('polling_id',$this->polling_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
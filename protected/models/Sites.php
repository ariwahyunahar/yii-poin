<?php

/**
 * This is the model class for table "sites".
 *
 * The followings are the available columns in table 'sites':
 * @property integer $id
 * @property string $site_name
 * @property string $slogan
 * @property integer $themes_id
 * @property integer $bannertop
 */
class Sites extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Sites the static model class
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
		return 'sites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_name, slogan, themes_id', 'required'),
			array('themes_id, bannertop', 'numerical', 'integerOnly'=>true),
			array('site_name, slogan', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, site_name, slogan, themes_id, bannertop', 'safe', 'on'=>'search'),
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
			'themes' => array(self::BELONGS_TO, 'Themes', 'themes_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'site_name' => 'Site Name',
			'slogan' => 'Slogan',
			'themes_id' => 'Themes',
			'bannertop' => 'Banner Top',
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
		$criteria->compare('site_name',$this->site_name,true);
		$criteria->compare('slogan',$this->slogan,true);
		$criteria->compare('themes_id',$this->themes_id);
		$criteria->compare('bannertop',$this->bannertop);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
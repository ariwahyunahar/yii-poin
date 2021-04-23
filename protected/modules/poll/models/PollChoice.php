<?php

/**
 * This is the model class for table "poll_choice".
 *
 * The followings are the available columns in table 'poll_choice':
 * @property string $id
 * @property string $poll_id
 * @property string $label
 * @property string $votes
 * @property integer $weight
 *
 * The followings are the available model relations:
 * @property Poll $poll
 */
class PollChoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PollChoice the static model class
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
		return 'poll_choice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('poll_id', 'required'),
			array('weight', 'numerical', 'integerOnly'=>true),
			array('poll_id, votes', 'length', 'max'=>11),
			array('label', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, poll_id, label, votes, weight', 'safe', 'on'=>'search'),
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
			'poll' => array(self::BELONGS_TO, 'Poll', 'poll_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'poll_id' => 'Poll',
			'label' => 'Label',
			'votes' => 'Votes',
			'weight' => 'Weight',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('poll_id',$this->poll_id,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('weight',$this->weight);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
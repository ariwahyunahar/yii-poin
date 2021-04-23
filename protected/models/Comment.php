<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property string $user
 * @property string $create_time
 * @property string $body
 * @property integer $publish
 * @property integer $content_id
 * @property integer $video_id
 *
 * The followings are the available model relations:
 * @property Content $content
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('publish, content_id, video_id', 'numerical', 'integerOnly'=>true),
			array('user', 'length', 'max'=>45),
			array('create_time, body', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, create_time, body, publish, content_id, video_id', 'safe', 'on'=>'search'),
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
			'content' => array(self::BELONGS_TO, 'Content', 'content_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'create_time' => 'Create Time',
			'body' => 'Body',
			'publish' => 'Publish',
			'content_id' => 'Content',
			'video_id' => 'Video',
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
		$criteria->compare('user',$this->user,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('video_id',$this->video_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
		
		if(!Yii::app()->user->isAdmin){
			$this->publish = 1;
			$this->user = Yii::app()->user->name;
		}
		
		if(!empty($_POST['Comment']['body'])){
			$this->body = mysql_escape_string($_POST['Comment']['body']);
		}
		return true;
	}
}
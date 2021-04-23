<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $id
 * @property string $title
 * @property string $source
 * @property string $body
 * @property string $intro
 * @property string $slug
 * @property string $create_time
 * @property string $update_time
 * @property integer $publish
 * @property integer $is_popular
 * @property integer $splash
 * @property string $ebook
 * @property string $event_start_time
 * @property string $event_end_time
 * @property integer $hits
 * @property integer $content_type_id
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property ContentType $contentType
 * @property ContentImage[] $contentImages
 * @property ContentVideo[] $contentVideos
 */
class Content extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Content the static model class
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
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content_type_id', 'required'),
			array('publish, is_popular, splash, hits, content_type_id', 'numerical', 'integerOnly'=>true),
			array('title, source, slug, ebook', 'length', 'max'=>255),
			array('body, intro, create_time, update_time, event_start_time, event_end_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, source, body, intro, slug, create_time, update_time, publish, is_popular, splash, ebook, event_start_time, event_end_time, hits, content_type_id', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'content_id'),
			'contentType' => array(self::BELONGS_TO, 'ContentType', 'content_type_id'),
			'contentImages' => array(self::HAS_MANY, 'ContentImage', 'content_id1'),
			'contentVideos' => array(self::HAS_MANY, 'ContentVideo', 'content_id1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'source' => 'Source',
			'body' => 'Body',
			'intro' => 'Intro',
			'slug' => 'Slug',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'publish' => 'Publish',
			'is_popular' => 'Is Popular',
			'splash' => 'Splash',
			'ebook' => 'Ebook',
			'event_start_time' => 'Event Start Time',
			'event_end_time' => 'Event End Time',
			'hits' => 'Hits',
			'content_type_id' => 'Content Type',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('is_popular',$this->is_popular);
		$criteria->compare('splash',$this->splash);
		$criteria->compare('ebook',$this->ebook,true);
		$criteria->compare('event_start_time',$this->event_start_time,true);
		$criteria->compare('event_end_time',$this->event_end_time,true);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('content_type_id',$this->content_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function findBySlug($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug AND publish = 1';
		$criteria->params = array(':slug' => $slug);
		return self::find($criteria);
	}
	
	public function addHit($id)
	{
		$query = 'UPDATE content SET hits = hits + 1 WHERE id = ' . mysql_escape_string($id);
		Yii::app()->db->createCommand($query)->execute();
	}
}
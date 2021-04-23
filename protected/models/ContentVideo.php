<?php

/**
 * This is the model class for table "content_video".
 *
 * The followings are the available columns in table 'content_video':
 * @property integer $id
 * @property string $file
 * @property integer $content_id1
 *
 * The followings are the available model relations:
 * @property Content $contentId1
 */
class ContentVideo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContentVideo the static model class
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
		return 'content_video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_id1', 'required'),
			array('content_id1', 'numerical', 'integerOnly'=>true),
			array('file, title, slug, ImgCover', 'length', 'max'=>255),
			array('description, upload_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, file, title, slug, upload_time, description, ImgCover, content_id1', 'safe', 'on'=>'search'),
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
			'contentId1' => array(self::BELONGS_TO, 'Content', 'content_id1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'file' => 'File',
			'title' => 'Title',
			'slug' => 'Slug',
			'ImgCover' => 'Cover Image',
			'description' => 'Description',
			'upload_time' => 'Upload Time',
			'content_id1' => 'Content Id1',
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
		$criteria->compare('file',$this->file,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('ImgCover',$this->ImgCover,true);
		$criteria->compare('upload_time',$this->upload_time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content_id1',$this->content_id1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
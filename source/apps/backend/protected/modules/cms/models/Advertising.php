<?php

/**
 * This is the model class for table "advertising".
 *
 * The followings are the available columns in table 'advertising':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $position
 * @property string $file_path
 * @property string $link
 * @property string $params
 * @property integer $order
 * @property integer $created
 * @property integer $published
 */
class Advertising extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advertising the static model class
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
		return 'advertising';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order, created, published', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('type', 'length', 'max'=>5),
			array('position', 'length', 'max'=>50),
			array('file_path, link', 'length', 'max'=>255),
			array('description, params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, type, position, file_path, link, params, order, created, published', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'type' => 'Type',
			'position' => 'Position',
			'file_path' => 'File Path',
			'link' => 'Link',
			'params' => 'Params',
			'order' => 'Order',
			'created' => 'Created',
			'published' => 'Published',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('created',$this->created);
		$criteria->compare('published',$this->published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
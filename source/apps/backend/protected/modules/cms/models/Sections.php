<?php

/**
 * This is the model class for table "sections".
 *
 * The followings are the available columns in table 'sections':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $images
 * @property string $description
 * @property integer $published
 * @property integer $ordering
 * @property integer $access
 * @property string $params
 */
class Sections extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sections the static model class
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
		return 'sections';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required'),
			array('published, ordering, access', 'numerical', 'integerOnly'=>true),
			array('title, slug', 'length', 'max'=>255),
			array('images, params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, slug, images, description, published, ordering, access, params', 'safe', 'on'=>'search'),
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
			'slug' => 'Slug',
			'images' => 'Images',
			'description' => 'Description',
			'published' => 'Published',
			'ordering' => 'Ordering',
			'access' => 'Access',
			'params' => 'Params',
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('access',$this->access);
		$criteria->compare('params',$this->params,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function behaviors(){
		return array(
			'SlugBehavior' => array(
				'class' => 'backend.components.SlugBehavior',
				'slug_col' => 'slug',
				'title_col' => 'title',
				//'max_slug_chars' => 125,
				'overwrite' => true
			)
		);
	}
}
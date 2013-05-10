<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $introtext
 * @property string $fulltext
 * @property integer $home
 * @property integer $sectionid
 * @property integer $catid
 * @property integer $created
 * @property integer $created_by
 * @property integer $modified
 * @property integer $modified_by
 * @property integer $published
 * @property integer $public_time
 * @property string $images
 * @property string $urls
 * @property integer $ordering
 * @property string $metakey
 * @property string $metadesc
 * @property string $metadata
 * @property integer $hits
 * @property string $params
 * @property integer $access
 * @property string $price
 * @property integer $amount
 * @property integer $discount
 * @property string $price_new
 * @property integer $promotions
 * @property integer $new
 * @property integer $fast_selling
 */
class Products extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Products the static model class
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
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, introtext, fulltext', 'required'),
			array('home, sectionid, catid, created, created_by, modified, modified_by, published, public_time, ordering, hits, access, amount, discount, promotions, new, fast_selling', 'numerical', 'integerOnly'=>true),
			array('title, slug', 'length', 'max'=>255),
			array('price, price_new', 'length', 'max'=>20),
			array('images, urls, metakey, metadesc, metadata, params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, slug, introtext, fulltext, home, sectionid, catid, created, created_by, modified, modified_by, published, public_time, images, urls, ordering, metakey, metadesc, metadata, hits, params, access, price, amount, discount, price_new, promotions, new, fast_selling', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$relations['category'] = array(self::BELONGS_TO, 'Categories', 'catid');
		return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Tên',
			'slug' => 'Slug',
			'introtext' => 'Introtext',
			'fulltext' => 'Fulltext',
			'home' => 'Hiển thị trang chủ',
			'sectionid' => 'Sectionid',
			'catid' => 'Danh mục',
			'created' => 'Created',
			'created_by' => 'Created By',
			'modified' => 'Modified',
			'modified_by' => 'Modified By',
			'published' => 'Hiển thị',
			'public_time' => 'Public Time',
			'images' => 'Images',
			'urls' => 'Urls',
			'ordering' => 'Thứ tự',
			'metakey' => 'Metakey',
			'metadesc' => 'Metadesc',
			'metadata' => 'Metadata',
			'hits' => 'Hits',
			'params' => 'Params',
			'access' => 'Access',
			'price' => 'Giá',
			'amount' => 'Số lượng',
			'discount' => 'Discount',
			'price_new' => 'Giá mới',
			'promotions' => 'Khuyến mãi',
			'new' => 'Sản phẩm mới',
			'fast_selling' => 'Bán chạy',
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
		$criteria->compare('introtext',$this->introtext,true);
		$criteria->compare('fulltext',$this->fulltext,true);
		$criteria->compare('home',$this->home);
		$criteria->compare('sectionid',$this->sectionid);
		$criteria->compare('catid',$this->catid);
		$criteria->compare('created',$this->created);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified',$this->modified);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('published',$this->published);
		$criteria->compare('public_time',$this->public_time);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('urls',$this->urls,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('metakey',$this->metakey,true);
		$criteria->compare('metadesc',$this->metadesc,true);
		$criteria->compare('metadata',$this->metadata,true);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('access',$this->access);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('price_new',$this->price_new,true);
		$criteria->compare('promotions',$this->promotions);
		$criteria->compare('new',$this->new);
		$criteria->compare('fast_selling',$this->fast_selling);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>50,
			)
		));
	}
	
	public function beforeSave(){
		$this->params = json_encode($this->params);
		if($this->isNewRecord){
			$this->created = time();
		}
		$this->modified = time();
		return parent::beforeSave();
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
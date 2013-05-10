<?php

/**
 * This is the model class for table "pay_detail".
 *
 * The followings are the available columns in table 'pay_detail':
 * @property integer $id
 * @property string $session_id
 * @property string $name
 * @property string $address
 * @property string $tel
 * @property string $email
 * @property integer $product_id
 * @property integer $amount
 * @property string $total_price
 * @property string $status
 * @property integer $created
 */
class PayDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PayDetail the static model class
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
		return 'pay_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, amount, created', 'numerical', 'integerOnly'=>true),
			array('session_id', 'length', 'max'=>32),
			array('name, address, tel, email', 'length', 'max'=>255),
			array('total_price, status', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session_id, name, address, tel, email, product_id, amount, total_price, status, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$relations['product'] = array(self::BELONGS_TO, 'Products', 'product_id');
		return CMap::mergeArray(
			$relations,
			parent::relations()
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'session_id' => 'Session',
			'name' => 'Tên',
			'address' => 'Địa chỉ',
			'tel' => 'Số ĐT',
			'email' => 'Email',
			'product_id' => 'Sản phẩm',
			'amount' => 'Số lượng',
			'total_price' => 'Tổng giá',
			'status' => 'Status',
			'created' => 'Created',
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
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>50,
			)
		));
	}
}
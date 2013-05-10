<?php
/**
 * OrderForm
 * @author INSPIRON
 *
 */
class OrderForm extends CFormModel
{
	public $amount;
	public $size;
	public $color;
	public $product_id;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// amount are required
			array('amount', 'required'),
			array('amount, size, color, product_id', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'amount'=>'Số lượng',
			'size'=>'Size',
			'color'=>'Màu',
		);
	}

}

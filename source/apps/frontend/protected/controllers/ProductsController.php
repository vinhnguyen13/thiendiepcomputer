<?php
class ProductsController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$catid = Yii::app()->request->getParam('catid');
		$products = new Products();
		$criteria = new CDbCriteria();
		$criteria->addCondition("published=1");
		$criteria->order = "created DESC";
		if(!empty($catid)){
			$criteria->addCondition("catid='$catid'");
		}
		/** Pagination **/
		$count = Products::model()->count($criteria);
		$pages = null;
        if($count > Yii::app()->params->pagination['product']){
        	$pages=new CPagination($count);
	        //Results per page
	        $pages->pageSize = Yii::app()->params->pagination['product'];
	        $pages->applyLimit($criteria);
        }
        
        $products = Products::model()->findAll($criteria);
		$this->render('index', array(
			'products'=>$products,
			'pages' => $pages
		));
	}

	public function actionView($id, $slug = null)
	{
		$breadcrumbs = array();
		$product = new Products();
		if(!empty($id)){
			$product = Products::model()->findByPk($id);
		}
		/* form order */
		$model = new OrderForm(); 
		/* order product */
		$OrderForm = Yii::app()->request->getPost('OrderForm');
		if(!empty($OrderForm)){
			$model->attributes = $OrderForm;
			$model->validate();
			$pro = Products::model()->findByPk($model->product_id);
			if(!empty($pro) && !$model->hasErrors()){
				$this->addToCart();
				$url = Yii::app()->createUrl('pay/index', array());
				$this->redirect($url);				
			}			
		}
		$products = array();
		$pages = array();
		if(!empty($product->catid)){
			$catid = $product->catid;
			$products = new Products();
			$criteria = new CDbCriteria();
			$criteria->addCondition("published=1");
			if(!empty($catid)){
				$criteria->addCondition("catid='$catid'");
			}
			/** Pagination **/
			$count = Products::model()->count($criteria);
	        $pages=new CPagination($count);
	        //Results per page
	        $pages->pageSize=12;
	        $pages->applyLimit($criteria);
	        
	        $products = Products::model()->findAll($criteria);
		}
		
		if(!empty($product->category)){
			$breadcrumbs[$product->category->title] = Yii::app()->createUrl('products/index', array('catid'=>$product->category->id, 'cslug'=>$product->category->slug));
			$breadcrumbs[$product->title] = '';
		}
		
		$this->render('view', array(
			'product'=>$product,
			'products'=>$products,
			'pages' => $pages,
			'model'=>$model,
			'breadcrumbs'=>$breadcrumbs,
		));
	}
	
	private function addToCart(){
		$model = new OrderForm(); 
		$OrderForm = Yii::app()->request->getPost('OrderForm');
		if(!empty($OrderForm)){
			$model->attributes = $OrderForm;
			
			$cartOld = Yii::app()->session->readSession('cart');	
			$cart = new stdClass();
			$cart->product_id = $model->product_id;
			$cart->amount = $model->amount;
			$cart->size = $model->size;
			$cart->color = $model->color;
			$totalCart[] = $cart;		
			if(!empty($cartOld)){
				$cartOld = json_decode($cartOld);				
				$totalCart = array_merge($totalCart, $cartOld);
			}		
			Yii::app()->session->writeSession('cart', json_encode($totalCart));
		}
	}
	
}
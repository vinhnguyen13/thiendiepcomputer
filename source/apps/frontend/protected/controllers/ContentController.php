<?php
class ContentController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionIntroduction()
	{
		$content = Content::model()->findByAttributes(array('sectionid'=>$this->sections->introduction));
		$this->render('introduction', array(
			'content'=>$content
		));
	}
	
	public function actionServices()
	{
		$content = Content::model()->findByAttributes(array('sectionid'=>$this->sections->services));
		$this->render('services', array(
			'content'=>$content
		));
	}
	
	public function actionPayment()
	{
		$content = Content::model()->findByAttributes(array('sectionid'=>$this->sections->pay));
		$this->render('payment', array(
			'content'=>$content
		));
	}
	
	public function actionView($id, $slug = null)
	{
		$content = new Content();
		if(!empty($id)){
			$content = Content::model()->findByPk($id);
		}
		$this->render('view', array(
			'content'=>$content
		));
	}
	
	public function actionSearch()
	{
		Yii::app()->layout = 'news';
		$sections = (object)Yii::app()->params->sections;
		$keyword = Yii::app()->request->getPost('keyword');
		$selecttitle = Yii::app()->request->getParam('selecttitle', $sections->news);
		if(empty($selecttitle)){
			$selecttitle = $sections->news;
		}
		
		if($selecttitle == $sections->products){
			Yii::app()->layout = 'products';
			$catid = Yii::app()->request->getParam('catid');
			$products = new Products();
			$criteria = new CDbCriteria();
			$criteria->addCondition("published=1");
			$criteria->addCondition("title LIKE '%$keyword%'");
			if(!empty($catid)){
				$criteria->addCondition("catid='$catid'");
			}
			/** Pagination **/
			$count = Products::model()->count($criteria);
	        $pages=new CPagination($count);
	        //Results per page
	        $pages->pageSize=10;
	        $pages->applyLimit($criteria);
	        
	        $products = Products::model()->findAll($criteria);
	        $this->render("search-product", array(
				'products'=>$products,
				'pages' => $pages
			));
		}elseif($selecttitle == $sections->news){
			$content = new Content();
			$criteria = new CDbCriteria();
			$criteria->addCondition("sectionid=".$this->sections->news);
			$criteria->addCondition("title LIKE '%$keyword%'");
			/** Pagination **/
			$count = Content::model()->count($criteria);
	        $pages=new CPagination($count);
	        //Results per page
	        $pages->pageSize=10;
	        $pages->applyLimit($criteria);
	        
	        $content = Content::model()->findAll($criteria);
			$this->render("search-news", array(
				'content'=>$content,
				'pages' => $pages
			));
		}elseif($selecttitle == $sections->services){
			$content = new Content();
			$criteria = new CDbCriteria();
			$criteria->addCondition("sectionid=".$this->sections->services);
			$criteria->addCondition("title LIKE '%$keyword%'");
			/** Pagination **/
			$count = Content::model()->count($criteria);
	        $pages=new CPagination($count);
	        //Results per page
	        $pages->pageSize=10;
	        $pages->applyLimit($criteria);
	        
	        $content = Content::model()->findAll($criteria);
			$this->render('search-services', array(
				'content'=>$content,
				'pages' => $pages
			));
		}
		
	}

}
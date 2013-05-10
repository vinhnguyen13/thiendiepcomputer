<?php
class NewsController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$content = new Content();
		$criteria = new CDbCriteria();
		$criteria->addCondition("sectionid=".$this->sections->news);
		$criteria->order = "created DESC";
		/** Pagination **/
		$count = Content::model()->count($criteria);
		$pages = null;
        if($count > Yii::app()->params->pagination['news']){
        	$pages=new CPagination($count);
	        //Results per page
	        $pages->pageSize = Yii::app()->params->pagination['news'];
	        $pages->applyLimit($criteria);
        }
        
        $content = Content::model()->findAll($criteria);
		$this->render('index', array(
			'content'=>$content,
			'pages' => $pages
		));
	}
	
	public function actionView($id, $slug = null)
	{
		$content = new Content();
		$criteria = new CDbCriteria();
		if(!empty($id)){
			$content = Content::model()->findByPk($id);
			$criteria->addCondition("id != $id");
		}
		/** get more **/
		$criteria->addCondition("sectionid=".$this->sections->news);
		$criteria->order = "created DESC";
        $moreContents = Content::model()->findAll($criteria);
        
		$this->render('view', array(
			'content'=>$content,
			'moreContents'=>$moreContents,
		));
	}

}
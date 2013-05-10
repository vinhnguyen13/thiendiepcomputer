<?php
class ServicesController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$content = new Content();
		$criteria = new CDbCriteria();
		$criteria->addCondition("sectionid=".$this->sections->services);
		/** Pagination **/
		$count = Content::model()->count($criteria);
        $pages=new CPagination($count);
        //Results per page
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        
        $content = Content::model()->findAll($criteria);
		$this->render('index', array(
			'content'=>$content,
			'pages' => $pages
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
}
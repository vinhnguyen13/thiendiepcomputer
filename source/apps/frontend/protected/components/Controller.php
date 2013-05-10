<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/default';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $sections;
	
	protected function beforeAction($action) {
		$this->sections = (object)Yii::app()->params->sections;
		/** set session user **/
		$user = Yii::app()->session->readSession('user');
		if(empty($user)){
			$user = new stdClass();
			$user->id = uniqid(time());
			Yii::app()->session->writeSession('user', json_encode($user));
		}
		/** set theme **/
		$this->handleLoadTheme($action);
		return parent::beforeAction($action);
	}
	
	protected function handleLoadTheme($action){
		$app = Yii::app();
		$theme = 'thiendiep';
		$layout = 'main';
		if(!empty($action->controller->id)){
			switch ($action->controller->id) {
				case 'site':
					break;
				case 'content':
				case 'news':
				case 'services':
					break;
				case 'pay':
				case 'products':
					break;
				default:
					break;
			}
		}
    	/**
    	 * set theme dynamic
    	 */
    	$app->setTheme($theme);
    	//$this->layout = 'main';
    	if(!empty($layout)){
    		$app->layout = $layout;
    		$this->layout = "//layouts/$layout";
    	}
    }
	
}
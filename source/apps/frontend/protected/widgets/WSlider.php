<?php
class WSlider extends CWidget {
    public function run() {
    	if(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index'){
	    	$this->render('slider',
	    		array(
	    		)
	    	);
    	}
    }
}

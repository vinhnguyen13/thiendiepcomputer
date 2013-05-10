<?php
class WProduct extends CWidget {
	public $view;
	public $limit = 6;
	public $section_id = '';
	
    public function run() {
    	if(!empty($this->view)){
    		$data = array();
    		switch ($this->view) {
				case 'sale_fast':
					$data['products'] = Products::model()->findAllByAttributes(array('fast_selling'=>1));
					break;
					
    		}
	    	$this->render($this->view, $data);
    	}
    }
}

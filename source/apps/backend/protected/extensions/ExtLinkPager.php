<?php
class ExtLinkPager extends CLinkPager
{
	const CSS_SELECTED_PAGE='current';
	const CSS_FIRST_PAGE='out';
	const CSS_LAST_PAGE='out';
	const CSS_PREVIOUS_PAGE='out';
	const CSS_NEXT_PAGE='out';
	const CSS_INTERNAL_PAGE='page';
	const CSS_HIDDEN_PAGE='hidden';
	public $header = '';
	public function init()
	{
		if($this->nextPageLabel===null)
			$this->nextPageLabel=Yii::t('yii','<img alt="Prev" src="'.Yii::app()->theme->baseUrl.'/resources/images/pagingnext.png">');
		if($this->prevPageLabel===null)
			$this->prevPageLabel=Yii::t('yii','<img alt="Prev" src="'.Yii::app()->theme->baseUrl.'/resources/images/pagingprev.png">');
		if($this->firstPageLabel===null)
			$this->firstPageLabel=Yii::t('yii','<img alt="Prev" src="'.Yii::app()->theme->baseUrl.'/resources/images/pagingprev.png"><img alt="Prev" src="'.Yii::app()->theme->baseUrl.'/resources/images/pagingprev.png">');
		if($this->lastPageLabel===null)
			$this->lastPageLabel=Yii::t('yii','<img alt="Prev" src="'.Yii::app()->theme->baseUrl.'/resources/images/pagingnext.png"><img alt="Prev" src="'.Yii::app()->theme->baseUrl.'/resources/images/pagingnext.png">');
		if($this->header===null)
			$this->header=Yii::t('yii','Go to page: ');

		if(!isset($this->htmlOptions['id']))
			$this->htmlOptions['id']=$this->getId();
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']='yiiPager';
	}
	/**
	 * Executes the widget.
	 * This overrides the parent implementation by displaying the generated page buttons.
	 */
	public function run()
    {
        // SET CUSTOM $this->header and $this->footer here
        $this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;
		echo $this->header;
		echo CHtml::tag('div',$this->htmlOptions,implode("\n",$buttons));
		echo $this->footer;
    }
	protected function createPageButtons()
	{
		if(($pageCount=$this->getPageCount())<=1)
				return array();
	
		list($beginPage,$endPage)=$this->getPageRange();
		$currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
		$buttons=array();
	
		// first page
		$buttons[]=$this->createPageButton($this->firstPageLabel,0,self::CSS_FIRST_PAGE,false,false);
	
		// prev page
		if(($page=$currentPage-1)<0)
				$page=0;
		$buttons[]=$this->createPageButton($this->prevPageLabel,$page,self::CSS_PREVIOUS_PAGE,$currentPage<=0,false);
	
		// internal pages
		for($i=$beginPage;$i<=$endPage;++$i)
				$buttons[]=$this->createPageButton($i+1,$i,self::CSS_INTERNAL_PAGE,false,$i==$currentPage);
	
		// next page
		if(($page=$currentPage+1)>=$pageCount-1)
				$page=$pageCount-1;
		$buttons[]=$this->createPageButton($this->nextPageLabel,$page,self::CSS_NEXT_PAGE,$currentPage>=$pageCount-1,false);
	
		// last page
		$buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,self::CSS_LAST_PAGE,$endPage>=$pageCount-1,false);
	
		return $buttons;
	}
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
		$controller = $this->getController();
		if(!empty($page)){
			$href = Yii::app()->createUrl($this->getPages()->createPageUrl($this->getController(), $page));
		}else{
			unset($_GET[$this->getPages()->pageVar]);
			$href = Yii::app()->createUrl($this->getController()->route, $_GET);
		}
		return CHtml::link($label, $href, array('class'=>$class));
	}

}
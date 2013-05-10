<?php
/**
 * Begin Request Behavior 
 * @author quangvinh
 *
 */
class BeginRequestBehavior extends CBehavior{
    public function attach($owner)
    {
        $owner->attachEventHandler('onBeginRequest',array($this,'handleLoadLanguage'));
    }
    
    public function handleLoadLanguage($event){        
        $app = Yii::app();
        if (isset($_GET['_lang']))
        {
            $app->language = $_GET['_lang'];
            $app->session['_lang'] = $app->language;
        }
        else if (isset($app->session['_lang']))
        {
            $app->language = $app->session['_lang'];
        }else{
            $app->language = 'vi';
        }
    }
   
}
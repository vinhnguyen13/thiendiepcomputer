<?php
return array(
	'webRoot' => dirname(dirname(dirname(__FILE__))),
	'phpmailer' => array(
		'transport'=>'smtp',
		'html'=>true,
		'properties'=>array(
			'CharSet' => 'UTF-8',
			'SMTPDebug' => false,
			'SMTPAuth' => true,
			'SMTPSecure' => 'ssl',
			'Host' => 'mail.like.vn',
			'Port' => 465,
			'Username' => 'noreply',
			'Password' => 'HI9U),1oL&hFMVJ*$BBr',
		),
		'msgOptions'=>array(
			'fromName' => 'DayBreak Online - DBO.vn',
			'toName'   => 'DayBreak Online - DBO.vn',
		),
	),
	'uploads'=>array(
		'photos'=>array(
			'extension'=>array('jpeg', 'jpg', 'gif', 'png'),
			'positions'=>array('banner'=>'Banner', 'character'=>'Character', 'advertising'=>'Advertising'),
			'resolutions'=>array('1024_768', '1152_864', '1280_800', '1280_1024', '1366_768', '1440_900', '1600_900', '1920_1080'),
		),
		'videos'=>array(
			'extension'=>array('flv')
		),
		'flash'=>array(
			'extension'=>array('swf')
		),
	),
	'pagination'=>array(
		'product'=>32,
		'news'=>12,
	),
	'sections'=>array(
		'home'=>1,
		'introduction'=>2,
		'products'=>3,
		'services'=>4,
		'news'=>5,
		'contact'=>6,
	)
);
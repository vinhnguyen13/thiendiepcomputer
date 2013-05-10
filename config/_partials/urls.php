<?php
return array(
		'trang-chu' 												=> 'site/index',
		'gioi-thieu'												=> 'content/introduction',
		'san-pham'													=> 'products',
		'san-pham/trang-<page:\d+>'									=> 'products/index',
		'san-pham/danh-muc/<catid:\d+>-<cslug>'						=> 'products/index',
		'san-pham/chi-tiet/<id:\d+>-<slug>/trang-<page:\d+>'		=> 'products/view',
		'san-pham/chi-tiet/<id:\d+>-<slug>'							=> 'products/view',
		'dich-vu'													=> 'content/services',
		'dich-vu/<id:\d+>-<slug>'									=> 'services/view',
		'tin-tuc'													=> 'news',
		'tin-tuc/trang-<page:\d+>'									=> 'news/index',
		'tin-tuc/<id:\d+>-<slug>'									=> 'news/view',
		'lien-he' 													=> 'site/contact',
		'dat-hang-thanh-toan'										=> 'content/payment',
		'tim-kiem'													=> 'content/search',
		'invite-friend'												=> 'site/invite',
			
		'<controller:\w+>/<id:\d+>'									=>'<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>'					=>'<controller>/<action>',
		'<controller:\w+>/<action:\w+>'								=>'<controller>/<action>',
);
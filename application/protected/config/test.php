<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
      'db'=> array ( 
          'connectionString' => 'mysql:host=localhost;port=3307;dbname=findorsave',
          'tablePrefix' => 'findorsave_',
          'emulatePrepare' => true,
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          'enableParamLogging' => true,
          'enableProfiling' => true,
      ),
		),
	)
);

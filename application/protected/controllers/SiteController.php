<?php

class SiteController extends CController {
  protected $dolphin, $data;
	public function actionIndex()	{
    /**$d = Dolphin::model()->findOrSaveWhere(array("nick"=>"me","poolId"=>1,));*/
    /**var_dump($d);  */
    /**$this->data = Values::escape( $_POST );*/
    /**$n = Dolphin::model()->findOrSaveBy('NickAndPoolId',array('me',2));*/
    /**var_dump($n);*/
    
    $m = Dolphin::model()->findOrSaveByNickAndPoolId('me',1);
    var_dump($m->attributes);
    /**$m = Dolphin::model()->findOrCreateByNickAndPoolId('me',1);*/
    /**var_dump($m->attributes);*/
    /**$m = Dolphin::model()->findByNickAndPoolId('me',1);*/
    /**var_dump($m->attributes);*/
	}
}

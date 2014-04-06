<?php

class SiteController extends CController {
  protected $dolphin, $data;
	public function actionIndex()	{
    $this->data = Values::escape( $_POST );
      $m = Dolphin::model();
  /**id             */

      $ret = $m->findOrSaveWhere(array("nick"=>"me","poolId"=>"1",));
      var_dump($ret);
	}
}

<?php

class m140405_123604_create_dolphin extends CDbMigration {
  public $tn = 'lsph_dolphin';
	public function up() {
      $this->createTable($this->tn, array('id'=>'pk', 'nick'=>'string', 'pool_id'=>'int'));
	}

	public function down() {
/** $this->dropTable($this->tn); */
      $this->execute('drop table if exists ' . $this->tn . '');
	}

}

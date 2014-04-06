<?php 

class DolphinTest extends CDbTestCase {
    public $fixtures=array(
        'dolphin'=>'Dolphin',
    );
 
    public function testSave() {
        $dolphin = Dolphin::model()->findOrSaveByNickAndPoolId('me',1);
        $this->assertEquals($dolphin->nick,'me');
        $this->assertEquals($dolphin->pool_id,1);

        $this->assertEquals($dolphin->nick, 'me');

        $dolphin=Dolphin::model()->findByPk($dolphin->id);

        $this->assertEquals($dolphin->nick,'me');
        $this->assertEquals($dolphin->pool_id,1);
    }
}

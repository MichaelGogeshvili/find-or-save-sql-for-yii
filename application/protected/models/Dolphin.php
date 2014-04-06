<?php

/**
 * This is the model class for table "lsph_dolphin".
 *
 * The followings are the available columns in table 'lsph_dolphin':
 * @property integer $id
 * @property string $nick
 * @property integer $pool_id
 */
class Dolphin extends BoostRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'lsph_dolphin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pool_id', 'numerical', 'integerOnly'=>true),
			array('nick', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nick, pool_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'nick' => 'Nick',
			'pool_id' => 'Pool',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('pool_id',$this->pool_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dolphin the static model class
	 */
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}
}

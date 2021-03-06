<?php
class BoostRecord extends CActiveRecord {
  protected $module_id;

  /**
   * Returns the database connection used by active record.
   *
   * @return  CDbConnection the database connection used by active record.
   */
  public function getDbConnection() {
    static $connection = null;
    return Yii::app()->db;
  }

  /**
   * Find the matching record or create it.
   *
   * You need to check if it is saved.
   *
   * @param array $attributes the attributes
   * @return  CActiveRecord a record.
   */
  public function findOrSaveWhere($attributes) {
    while($item = each($attributes)) { 
      $v = $item['value'];
      $k = self::camelToUnder($item['key']);
      $k = strtolower($k);
      $a[$k] = $v; 
    }
    $className = get_class($this);
    $object = $this->findByAttributes($a);
    if ($object !== null) {
      return $object;
    }
    if ($object === null) {
      $object = new $className;
      $object->attributes = $a;
      $object->validate() && $object->save();
      if(!$object->isNewRecord) {
        return $object;
      }
      else 
        throw new RuntimeException($object->errors);
    }
  }  
  /**
   * Turn text from camel case to undercored notation.
   *
   * @access public
   * @param string text - text in camel case notation
   * @return text - text in underscore notation
   */
  static function camelToUnder($text) {
    $text = preg_replace('/([a-z])([A-Z])/e'
        , "'\\1' . '_' . strtolower('\\2')", $text);

    return strtolower($text);
  }
}

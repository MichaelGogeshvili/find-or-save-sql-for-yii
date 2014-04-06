<?php
/**
 *
 *
 *
 *
 */
class BoostRecord extends CActiveRecord {
  
  public function findOrSaveWhere($attributes) {

    while($item = each($attributes)) { 
      $k = self::camelToUnder($item['key']);
      $v = $item['value'];
      $a[$k] = $v; 
    }
    $ret = self::findByAttributes($a) ;
    if($ret) return $ret;
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

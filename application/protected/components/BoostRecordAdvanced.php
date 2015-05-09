<?php
/**
 * (#)protected/components/BoostRecordAdvanced.php
 */
class BoostRecordAdvanced extends BoostRecord 
{

  public function __call($m, $a) {
    $prefix = $this->methodPrefix($m, 'By');
    if($prefix == 'findOrSave') {
      $affix = $this->methodAffix($m, 'By');
      return self::findOrSaveBy($affix, $a);
    }
    return parent::call ($m, $a);
  }
  /**
   *
   * Handle calls with findOrSaveBy* prefix
   *
   * @param method
   * @param arguments
   * @return mixed
   */
  public function findOrSaveBy($affix,$values) {
    $keys = explode('And',$affix);
    $klen = count($keys);
    $vlen = count($values);
    assert($klen = $vlen);
    while($knext = each($keys)) {      
      $v=each($values);
      $tmp[$knext['value']] = $v['value'];
    }
    return $this->findOrSaveWhere($tmp);
  }
   

  /**
   * @access public
   * @param method - text to process
   * @return string - the prefix part containing funcional verbs
   */
   public function methodPrefix($method, $separator = 'By') {
     $chunks = $this-> camelSplit($method);
     $chLen = count($chunks);
     $off = array_search($separator, $chunks) - 0;
     assert($off>0); 
     return $this->implode(array_slice($chunks, 0, $off, true));
   }

  /**
   * @access public
   * @param method - text to process
   * @return string - the remaining part containing arguments names
   */

   public function methodAffix($method, $separator = 'By') {
     $chunks = $this-> camelSplit($method);
     $chLen = count($chunks);assert($chLen);
     $off = array_search($separator, $chunks) + 1;
     assert($off>1); 
     assert($chLen - $off); 
     return $this->implode(array_slice($chunks, $off, $max = $chLen - $off, true));
   }
   
  /**
   * Turn text from camel case to array
   *
   * @scope static
   * @param string text - text in camel case notation
   * @return array - broken down into word array('sentence', 'Case')
   */
   public static function camelSplit($text) {   
     return preg_split("/.{0}(?=[A-Z][^A-Z])/",$text); 
   }
    

   /**
    * @param array input - array to implode
    * @return string imploded
    */
   public static function implode($a) { return implode('', $a); }

   /**
    * Turn text from camel case to undercored notation.
    *
    * @access public
    * @param string text - text in camel case notation
    * @return text - text in underscore notation
    *
    *  public static function camelToUnder($text) {
    *    $text = preg_replace('/([a-z])([A-Z])/e'
    *        , "'\\1' . '_' . strtolower('\\2')", $text);
    *
    *    return strtolower($text);
    *  }
    */







   /**
    * Turn text from undercored into camel case.
    *
    * @access public
    * @param string text - text in underscore notation
    * @return string - text in camel case notation
    *  function underToCamel($text, $upperCamelCase = false) {
    *        $text = preg_replace('/_([a-z])/e', "strtoupper('\\1')", $text);
    *        
    *        $text = $upperCamelCase
    *            ? ucfirst($text)
    *            : strtolower( substr($text, 0, 1) ) . substr($text, 1)
    *            ;
    *        
    *        return $text;
    *  }
    *
    */
}

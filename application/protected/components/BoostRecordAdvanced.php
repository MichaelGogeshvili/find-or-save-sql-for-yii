<?php
/**
 */
class BoostRecord extends CActiveRecordAdvanced {
   /**
    * Process call
    *
    * @param method
    * @param arguments
    * @return mixed
    */
  public  function __call($method,$arguments) {
    if($method == 'pass') {
      var_dump(__LINE__); 
      var_dump($arguments);
      return null;

    }
    $chunks = $this->camelSplit($method);
    $chLen = count($chunks);
    if($whPos = array_search('Where',$chunks) ) {
        assert($whPos == $chLen - 1);
        $construct = $arguments;    
    }
    else {
        $construct = explode('And',join('',$this->argPart($method)));
    }
    
    $this->pass(join('',$this->camelSplit($method)),  $construct);
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
   * Turn text from camel case to undercored notation.
   *
   * @access public
   * @param string text - text in camel case notation
   * @return text - text in underscore notation
   */
  function camelToUnder($text) {
    $text = preg_replace('/([a-z])([A-Z])/e'
        , "'\\1' . '_' . strtolower('\\2')", $text);

    return strtolower($text);
  }

  /**
   * Turn text from undercored into camel case.
   *
   * @access public
   * @param string text - text in underscore notation
   * @return string - text in camel case notation
   */
  function underToCamel($text, $upperCamelCase = false)
  {
        $text = preg_replace('/_([a-z])/e', "strtoupper('\\1')", $text);
        
        $text = $upperCamelCase
            ? ucfirst($text)
            : strtolower( substr($text, 0, 1) ) . substr($text, 1)
            ;
        
        return $text;
  }
  /**
    * @access private
    * @param method text to process
    */
  private function argPart($method, $separator = 'By'){
    $chunks = $this-> camelSplit($method);
    $chLen = count($chunks);assert($chLen);
    $off = array_search($separator, $chunks) + 1;
    assert($off>1); 
    assert($chLen - $off); 
    return $argPart = array_slice($chunks, $off, $max = $chLen - $off, true);
  }
}

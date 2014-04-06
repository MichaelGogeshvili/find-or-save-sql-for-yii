<?php
/**
 * Author: Elmar Abdurayimov
 * Author email: e.abdurayimov@gmail.com
 * Date: 11/4/13
 * Time: 10:27 AM
 */


class Values
{

    /**
     * Escapes values
     *
     * @param array $values array of values to escape
     * @return string string ready to be included into SQL statement
     * @throws CException if one of the values isn't a scalar
     */
    public static function escape($value)
    {
        if (is_array($value)) {
            $values = (array)$value;
            $escaped = array();
            foreach ($values as $key => $value) {
                if (!is_scalar($value)) {
                    throw new CException('One of the values passed to values() is not a scalar.');
                }
                $escaped[$key] = htmlspecialchars(addslashes($value));
            }
        } else {
            $escaped = htmlspecialchars(addslashes($value));
        }
        return $escaped;
    }
}
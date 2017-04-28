<?php
namespace App\Lib;
class Params
{
    /** @noinspection PhpDocSignatureInspection */
    /**
     * returns the value of a POST array element
     *
     * @param $name - the parameter name
     * @param $validator - the validator function to use
     * @param ... - parameters for the specified validator function
     * @return mixed
     */
    public static function Post($name)
    {
        $args = func_get_args();
        return self::_getRQValue($_POST, $args);
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * returns the value of a GET array element
     *
     * @param $name - the parameter name
     * @param $validator - the validator function to use
     * @param ... - parameters for the specified validator function
     * @return mixed
     */
    public static function Get($name)
    {
        $args = func_get_args();
        return self::_getRQValue($_GET, $args);
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * returns the value of a GET array element
     *
     * @param $name - the parameter name
     * @param $validator - the validator function to use
     * @param ... - parameters for the specified validator function
     * @return mixed
     */
    public static function Cookie($name)
    {
        $args = func_get_args();
        return self::_getRQValue($_COOKIE, $args);
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * returns the value of a REQUEST array element
     *
     * @param $name - the parameter name
     * @param $validator - the validator function to use
     * @param ... - parameters for the specified validator function
     * @return mixed
     */
    public static function Request($name)
    {
        $args = func_get_args();
        return self::_getRQValue($_REQUEST, $args);
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * does the actual work for the getGetValue, getPostValue and getRequestValue functions
     *
     * @param $superarray - the $_GET, $_POST or $_REQUEST array
     * @param $params - the arguments from the getGetValue, getPostValue
     *                  and getRequestValue functions
     *                  [0]=$name
     *                  [1]=$validator
     *                  [2...]=arguments to the validator function
     * @return mixed|string
     */
    public static function _getRQValue($superarray, $params)
    {
        if (isset($superarray[$params[0]])) {
            $raw = $superarray[$params[0]];
        } else {
            $raw = '';
        }

        if (!isset($params[1])) return $raw;
        $validator = $params[1];
        unset($params[0]);
        $params[1] = $raw;

        if (function_exists("validate" . $validator)) {
            return call_user_func_array("validate" . $validator, $params);
        } else {
            die("Validation function " . $validator . " does not exist\n");
        }
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * Validates the input, ensuring it's an integer, optionally between min and max
     * If the value of input is not valid returns false
     *
     * @param $input - raw input
     * @param $min - minimum permitted value
     * @param $max - maximum permitted value
     * @return int|bool
     */
    function validateInteger($input, $min = false, $max = false, $default = false)
    {
        $matches = array();
        if (preg_match("/^-?[0-9]*$/", $input, $matches) == 1 && $matches[0] == $input) {
            if ($min !== false && $input < $min) return $default;
            if ($max !== false && $input > $max) return $default;
            return (int)$input;
        } else {
            return $default;
        }
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * Validates the input, ensuring that the input is one of the permitted values.
     * If the value is not valid, the default is returned, which is any empty string,
     * unless specified otherwise.
     *
     * @param $input - raw input
     * @param $permittedvalues - array of permitted values
     * @param $default - default value
     * @return mixed
     */
    function validateEnumeration($input, $permittedvalues, $default = "")
    {
        $keyarray = array_flip($permittedvalues);
        if (isset($keyarray[$input])) return $input;
        else return $default;
    }

    /** @noinspection PhpDocSignatureInspection */
    /**
     * Validates an array input.
     *
     * @param mixed $input - the raw input
     * @param string $elementValidator - the validator to use for validating individual values in the array.
     * @param mixed $param,... parameters for the values validator.
     * @return array
     */
    function validateArray()
    {
        $args = func_get_args();
        $default = array_shift($args);
        $input = array_shift($args);
        $elementValidator = array_shift($args);

        if (!is_array($input)) return $default;

        if (function_exists("validate" . $elementValidator)) {
            foreach ($input as $key => $value) {
                $input[$key] = call_user_func_array("validate" . $elementValidator, $args);
            }
            return $input;
        } else {
            die("Validation function " . $elementValidator . " does not exist\n");
        }
    }
}

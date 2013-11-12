<?php
class parseString {
    
    var $string = null;
    var $params = null;
    var $separator = null;
    
    function parseString($value, $separator = "\n") {
        $this->separator = $separator;
        if(is_array($value)) {
            $this->params = $value;
        } else
            if(is_string($value)) {
                $this->string = $value;
            } else {
                return;
            }
    }

    // Rozbyvae, koly typ takyi key1=value1 key2=value2
    function parseStringToParams() {
        if (!$this->string)
            return '';
        $params = explode($this->separator, $this->string);
        foreach ($params as $param) {
            $ext_param = explode("=",$param);
            if (!$ext_param[0]) continue;
            $this->params[trim($ext_param[0])] = trim($ext_param[1]);
        }
        return $this->params;
    }

    // Robyt split typu key1=value1 key2=value2
    function splitParamsToString() {
        $this->string = '';
        foreach ($this->params as $key => $value) {
            $this->string .= trim($key) . "=" . trim($value) . $this->separator;
        }
        return $this->string;
    }


    // Rozbyvae, koly typ takyi |value1}value2}
    function parseStringToParams2() {
        $params = explode($this->separator,$this->string);
        foreach ($params as $param) {
            if(!$param)
                continue;
            $this->params[trim($param)] = trim($param);
        }
    }

    function getArrayObject($key_name) {
        $this->parseStringToParams2();
        $arr_ret = array();
        if(!count($this->params))
            return null;
        foreach ($this->params as $param) {
            $obj->$key_name = $param;
            $arr_ret[] = $obj;
            unset($obj);
        }
        return $arr_ret;
    }

    // Robyt split type |value1|value2}
    function splitParamsToString2() {
        $this->string = $this->separator;
        foreach ($this->params as $key => $value) {
            $this->string .= $value . $this->separator;
        }
        return $this->string;
    }
}
?>
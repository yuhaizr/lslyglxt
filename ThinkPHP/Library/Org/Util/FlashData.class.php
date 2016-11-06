<?php
namespace Org\Util;

class FlashData
{
    private static $list = array();
    
    static public function flash($key, $value)
    {
        session($key, $value);
        
        array_push(self::$list, $key);
    }
    
    static public function getList()
    {
        return self::$list;
    }
}

?>
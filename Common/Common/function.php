<?php

function guid ()
{
    // if (function_exists('com_create_guid')){
    // return com_create_guid();
    // }else{
    mt_srand((double) microtime() * 10000); // optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45); // "-"
    $uuid =     // chr(123)// "{"
    substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen .
             substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen .
             substr($charid, 20, 12);
    // .chr(125);// "}"
    return $uuid;
    // }
}

/**
 * 取证书KEY
 *
 * @param <type> $cert
 * @return <type>
 */
function get_cert_md5 ($cert)
{
    $cert = str_replace("\n", "", $cert);
    $cert = str_replace("-----BEGIN CERTIFICATE-----", "", $cert);
    $cert = str_replace("-----END CERTIFICATE-----", "", $cert);
    return strtoupper(md5(base64_decode($cert)));
}

/**
 * 判断用户是否签约，0未签约，1已签约
 *
 * @param unknown $status
 * @return string
 */
function IsSigned ($status)
{
    if ($status === 0 || $status === '0') {
        return "未签约";
    } else {
        return "已签约";
    }
}

/**
 * 判断用户是否已经注册,根据是否存在用户id来判断
 *
 * @param unknown $status
 * @return string
 */
function isRegister ($cust_id)
{
    if ($cust_id) {
        return "已注册";
    } else {
        return "未注册";
    }
}



function fix_date ($date)
{
    $date = str_replace(array(
            "+",
            "'"
    ), " ", $date);
    return $date;
}


/**
 * 修改身份证号码的格式
 * 中间添加*号
 * @param unknown $identitycard
 */
function fix_identitycard($identitycard){
    if($identitycard&&(strlen($identitycard)>13)){
        $identitycard = substr_replace($identitycard,'********',6,8 );
    }

    return $identitycard;
}

/**
 * 添加文件锁
 * @param unknown $tmpFileStr
 * @param string $locktype
 * @return resource|boolean
 */
function lock_thisfile($tmpFileStr,$locktype=false){
    
    $lock_url = APP_PATH.'Runtime/lockFile/';
    if(!file_exists($lock_url)){
        mkdir($lock_url);
    }
    $tmpFileStr = $lock_url.$tmpFileStr;
    if($locktype == false){
        $locktype = LOCK_EX|LOCK_NB;
    }

    $can_write = 0;
    $lockfp = fopen($tmpFileStr.".txt","w");

    if($lockfp){
        $can_write = flock($lockfp,$locktype);
    }

    if($can_write){
        return $lockfp;
    }else{
        if($lockfp){
            fclose($lockfp);
            unlink($tmpFileStr.".lock");
        }
        return false;
    }
}
/**
 * 去除文件锁
 * @param unknown $tmpFileStr
 */
function unlock_thisfile($fp,$tmpFileStr){
    $lock_url = APP_PATH.'Runtime/lockFile/';
    $tmpFileStr = $lock_url.$tmpFileStr.".txt";
    $a = file_exists($tmpFileStr);
    if (file_exists($tmpFileStr)){
       	@flock($fp,LOCK_UN);
		@fclose($fp);
		@unlink($tmpFileStr);
    }
    

}

/**
 * 根据时间范围字符串返回开始时间和结束时间
 * 如果$time_range为空则返回当天零点到当前时间
 * @param unknown $time_range
 */
function fix_range_time($time_range){
    if((!isset($time_range))
            ||(!$time_range)){
        $start_date = date('Y-m-d 00:00:00');
        $end_date = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')) + 60*3);
    }else{
        $TimeArr = explode('__', $time_range);
        $start_date = date("Y-m-d 00:00:00",
                strtotime(trim($TimeArr[0])));
       // $end_date = date("Y-m-d H:i:s", strtotime(trim($TimeArr[1])));
       $end_date =  date("Y-m-d", strtotime(trim($TimeArr[1])))." 23:59:59";
    }
    return array('start_date'=>$start_date,
                 'end_date'=>$end_date);
}


function echoJson($status,$message,$data = array()){
    
    $res = array(
            'status' => $status
           ,'message' => $message
           ,'data' => $data 
    );
    
    $res = json_encode($res);
    echo  $res;
    exit();
}

/**
 * 字数统计
 * @param unknown $str
 * @param string $encoding
 */
function mbstrlen($str,$encoding="utf8")
{

    if (($len = strlen($str)) == 0) {
        return 0;
    }

    $encoding = strtolower($encoding);

    if ($encoding == "utf8" or $encoding == "utf-8") {
        $step = 3;
    } elseif ($encoding == "gbk" or $encoding == "gb2312") {
        $step = 2;
    } else {
        return false;
    }

    $count = 0;
    for ($i=0; $i<$len; $i++) {
        $count++;
        //如果字节码大于127，则根据编码跳几个字节
        if (ord($str{$i}) >= 0x80) {
            $i = $i + $step - 1;//之所以减去1，因为for循环本身还要$i++
        }
    }
    return $count;
}


/**
 +----------------------------------------------------------
* 字符串截取，支持中文和其他编码
+----------------------------------------------------------
* @static
* @access public
+----------------------------------------------------------
* @param string $str 需要转换的字符串
* @param string $start 开始位置
* @param string $length 截取长度
* @param string $charset 编码格式
* @param string $suffix 截断显示字符
* @param string $strength 字符串的长度
+----------------------------------------------------------
* @return string
+----------------------------------------------------------
*/
function msubstr($str, $start=0, $length, $strength,$charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr")){
        if($suffix){
            if($length <$strength ){
                return mb_substr($str, $start, $length, $charset)."....";
            }else{
                return mb_substr($str, $start, $length, $charset);
            }
        }else{
            return mb_substr($str, $start, $length, $charset);
        }

         
    }elseif(function_exists('iconv_substr')) {
        if($suffix){//是否加上......符号
            if($length < $strength){
                return iconv_substr($str,$start,$length,$charset)."....";
            }else{
                return iconv_substr($str,$start,$length,$charset) ;
            }
        }else{
            return iconv_substr($str,$start,$length,$charset) ;
        }

         
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix){
        return $slice."…";
    } else{
        return $slice;
    }
    

     
}



/**
 * 根据时间范围字符串返回开始日期和结束日期
 * @param unknown $time_range
 * @return multitype:unknown
 */
function fix_range_date($time_range){
    if((!isset($time_range))
        ||(!$time_range)){
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d',strtotime(date('Y-m-d H:i:s')) + 60*3);
    }else{
        $TimeArr = explode('__', $time_range);
        $start_date = date("Y-m-d",
            strtotime(trim($TimeArr[0])));
        $end_date =  date("Y-m-d", strtotime(trim($TimeArr[1])))."";
    }
    return array('start_date'=>$start_date,
        'end_date'=>$end_date);
}

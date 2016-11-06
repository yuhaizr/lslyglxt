<?php
namespace Org\Util;


use Think\Log;
/**
 *  Express.class.php  快递查询类
 *
 * @copyright           widuu
 * @license         http://www.widuu.com
 */
class Express {

  private $expressname =array(); //封装了快递名称

  function __construct(){
      $this->expressname = $this->expressname();
  }

   

  /*
   * 通过URL获取相关的返回内容
   */
  private function getcontent($url){

      if(function_exists("file_get_contents")){
          
          $opts = array(
                  'http'=>array(
                          'method'=>"GET",
                          'timeout'=>3,//单位秒
                  )
          );
          $cnt=0;
          try {
              while($cnt<3 && ($file_contents=file_get_contents($url, false, stream_context_create($opts)))===FALSE){
                  $cnt++;
              }
  
          } catch (\Exception $e) {
             throw $e;
          }
          
          if ($file_contents){
              return $file_contents;
          }else{
              return array('status'=>'9999'
                           ,'message'=>'信息获取失败');
          }

      }else{

          $ch = curl_init();

          $timeout = 5;

          curl_setopt($ch, CURLOPT_URL, $url);

          curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

          curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

          $file_contents = curl_exec($ch);

          curl_close($ch);

      }

      return $file_contents;

  }

 

  /*
   * 解析object成数组的方法
   * @param $json 输入的object数组
   * return $data 数组
   */
  private function json_array($json){
      if($json){
          foreach ((array)$json as $k=>$v){
              $data[$k] = !is_string($v)?$this->json_array($v):$v;
          }
          return $data;
      }
  }

   

  /*
   * 返回$data array      快递数组
   * @param $name         快递名称
   * @param $order        快递的单号
   * $data['ischeck'] ==1   已经签收
   * $data['data']        快递实时查询的状态 array
   */
  public  function getorder($name,$order){

      $keywords = $this->expressname[$name];
      try {
          $result = $this->getcontent("http://www.kuaidi100.com/query?type={$keywords}&postid={$order}");
      	
      } catch (\Exception $e) {
          throw $e;
      }
      

      $result = json_decode($result);

      $data = $this->json_array($result);

      return $data;
  }
  
  /*
   * 获取对应名称和对应传值的方法
  */
  private function expressname(){
  
      $name = array(  '圆通速递'  =>  'yuantong',
              '顺丰速运'  =>  'shunfeng',
              "德邦"     =>  "debangwuliu",
              "天地华宇"  =>  "tiandihuayu",
              "速尔物流"  =>  "suer",
              "优速快递"  =>  "youshuwuliu",
              "远成物流"  =>  "yuanchengwuliu",
              "佳怡物流"  =>  "jiayiwuliu",
              "龙邦速递"  =>  "longbanwuliu",
              "申通物流"  =>  "shentong",
              "安能物流"  =>  "annengwuliu",
              "安迅物流"  =>  "anxl",
              "百腾物流"  =>  "baitengwuliu",
              "传喜物流"  =>  "chuanxiwuliu",
              "大田物流"  =>  "datianwuliu",
              "飞康达"    =>  "feikangda",
              "GLS"     =>  "gls",
              "共速达"    =>  "gongsuda",
              "恒路物流"  =>  "hengluwuliu",
              "华夏龙"    =>  "huaxialongwuliu",
              "昊盛物流"  =>  "haoshengwuliu",
              "户通物流"  =>  "hutongwuliu",
              "佳吉物流"  =>  "jiajiwuliu",
              "急先达"    =>  "jixianda",
              "金大物流"  =>  "jindawuliu",
              "捷特物流"  =>  "jietekuaidi",
              "康力物流"  =>  "kangliwuliu",
              "跨越物流"  =>  "kuayue",
              "联昊通"    =>  "lianhaowuliu",
              "明亮物流"  =>  "mingliangwuliu",
              "南京晟邦"  =>  "nanjingshengbang",
              "陪行物流"  =>  "peixingwuliu",
              "日昱物流"  =>  "riyuwuliu",
              "盛辉物流"  =>  "shenghuiwuliu",
              "上大物流"  =>  "shangda",
              "圣安物流"  =>  "shenganwuliu",
              "穗佳物流"  =>  "suijiawuliu",
              "万家物流"  =>  "wanjiawuliu",
              "新邦物流"  =>  "xinbangwuliu",
              "信丰物流"  =>  "xinfengwuliu",
              "邮政国内"  =>  "youzhengguonei",
              "邮政国际"  =>  "youzhengguoji",
              "越丰物流"  =>  "yuefengwuliu",
              "原飞航"   =>  "yuanfeihangwuliu",
              "宇鑫物流"  =>  "yuxinwuliu",
              "煜嘉物流"  =>  "yujiawuliu",
              "中铁物流"  =>  "ztky",
              "中邮物流"  =>  "zhongyouwuliu"
            );
      
      return $name;

  }
  
}
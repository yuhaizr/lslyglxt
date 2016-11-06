<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Think\Upload;


class UploadController extends BaseController
{
    
    public function uploadImg(){
        $path = I('path');
       
        $file_name = I('file_name');
        $rootPath = __REAL_APP_ROOT__."/Public/upload/lcqd/";
        if (!is_dir(__REAL_APP_ROOT__."/Public/upload/")){
            mkdir(__REAL_APP_ROOT__."/Public/upload/",0777);
            if (!is_dir(__REAL_APP_ROOT__."/Public/upload/lcqd/")){
                mkdir(__REAL_APP_ROOT__."/Public/upload/lcqd/",0777);
            }
            
        }
    
        $config = array(
                         'exts' => array('png','gif','jpg','jpeg')
                        ,'rootPath' => $rootPath
                        ,'saveName' => $file_name
                        ,'subName' => ''
                        ,'replace' => true
                        ,'callback' => true
        );
        $upload = new Upload($config);
        
        $info = $upload->upload();
         if (!$info){
             $this->crmError($upload->getError());
         }else {
             $data['lcqd_img_name'] = $info['file']['savename'];
             $product = M('Product');
             $where = array('productcode'=>$file_name);
             $res = $product->where($where)->save($data);
             if ($res){
                 $this->crmSuccess($info['saveName'].'上传成功');
             }else{
                 $this->crmError('产品信息更新失败');
             }
             
         }
    }
    
}
    
    
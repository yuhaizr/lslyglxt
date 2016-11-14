<?php
namespace Home\Controller;

use Home\Model\ScenicSpotModel;
use Think\Upload;
/**
 * 景点管理
 * @author Administrator
 *
 */
class ScenicSpotController extends BaseController
{
    
    public function showList(){
        $searchValue = I('searchValue');
        $scenicSpotModel = new ScenicSpotModel();
        $data = $scenicSpotModel->scenicSpotList($searchValue);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchValue',$searchValue);
        $this->display();
    }
    
    public function detail(){
        $scenicSpot = M('ScenicSpot');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $scenicSpot->where($where)->find();
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }
    public function modify(){
        $scenicSpot = M('ScenicSpot');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $scenicSpot->where($where)->find();
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }   
    public function  add(){
        if ('menu' == I('type')){
            $this->display();exit();
        }
        $data = $_POST;
        

        if ($_FILES['imglink']['name'] ){
            $imageinfo = $this->saveImage();
            if(isset($imageinfo['imglink']) && $imageinfo['imglink']){
                $data['imglink'] = $imageinfo['imglink'];
            }else{
                unset($data['imglink']);
            }
        
        }else{
            unset($data['imglink']);
        }
        
        $scenicSpot = M('ScenicSpot');
        $this->check($data);
        
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['cuid'] = $_SESSION['authId'];
        $res = $scenicSpot->add($data);
        if ($res == false){
            $this->error('添加失败');
        }else{
            $this->success('添加成功','showList');
        }
        
    }
    
    public function save(){
        $id = I('id');
        $data = $_POST;
        $scenicSpot = M('ScenicSpot');
        $this->check($data);
        
        
        if (isset($id) && $id){
        
            $where['id'] = $id;
          
            if ($_FILES['imglink']['name'] ){
                $imageinfo = $this->saveImage();
                if(isset($imageinfo['imglink']) && $imageinfo['imglink']){
                    $data['imglink'] = $imageinfo['imglink'];
                }else{
                    unset($data['imglink']);
                }
            
            }else{
                unset($data['imglink']);
            }
            
            $res = $scenicSpot->where($where)->save($data);
             
            if ($res === false){
                $this->error('保存失败');
            }else{
                $this->success('保存成功','showList');
            }
        
        
        }else{
            $this->error('id 丢失');
        }
    }
    
    public function del(){
        $id = I('id');

        $scenicSpot = M('ScenicSpot');

        if (isset($id) && $id){
            $data['is_valid'] = '0';
            $where['id'] = $id;
            $res = $scenicSpot->where($where)->save($data);
             
            if ($res === false){
                $this->error('删除失败');
            }else{
                $this->success('删除成功','showList');
            }
        
        
        }else{
            $this->error('id 丢失');
        }
    }
    
    

    public function addScenicSpot(){
        $scenicSpot = M('ScenicSpot');
        $id = I('id');
        
        if ('menu' == I('type')){
            if (isset($id) && $id){
                $where['id'] = $id;
                $info = $scenicSpot->where($where)->find();
                $this->assign('info',$info);
            }
            $this->display();
            exit();
        }else {
            $data = $_POST;
            $this->check($data);
            
            
            if (isset($id) && $id){
                
                $where['id'] = $id;
                $res = $scenicSpot->where($where)->save($data);
             
                if ($res === false){
                    $this->error('保存失败');
                }else{
                    $this->success('保存成功','scenicSpotList');
                }
                
                
            }else{
                $data['ctime'] = date('Y-m-d H:i:s');
                $data['cuid'] = $_SESSION['authId'];
                $res = $scenicSpot->add($data);
                if ($res == false){
                    $this->error('添加失败');
                }else{
                    $this->success('添加成功');
                }
                
            }
            
            
            
        }
        
    }
    
    private function check($data){
        
        if (!isset($data['name']) || !$data['name']){
            $this->error('景点名称必填');
        }
        if (!isset($data['intro']) || !$data['intro']){
            $this->error('景点概况必填');
        }     
        if (mbstrlen($data['name']) >30){
            $this->error('景点名称必需小于30字');
        }
  
        if(strtotime($data['start_time']) > strtotime($data['end_time'])){
            $this->error("开发开始时间不能大于开放结束时间");
        }
    }
    
    public function scenicSpotList(){
        $searchValue = I('searchValue');
        $scenicSpotModel = new ScenicSpotModel();
        $data = $scenicSpotModel->scenicSpotList($searchValue);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        
        $this->display();
    }
    
    private function saveImage(){
    
        $rootPath = __REAL_APP_ROOT__."/Public/upload/";
        if (!is_dir(__REAL_APP_ROOT__."/Public/upload/")){
            mkdir(__REAL_APP_ROOT__."/Public/upload/",0777);
    
        }
    
        $config = array(
            'rootPath' => $rootPath
            ,'subName' => ''
            ,'replace' => true
            ,'callback' => true
            ,'exts' => array('png','gif','jpg','jpeg')
        );
    
        $upload = new Upload($config);
        $upload->autoSub = true;
        $upload->subName = array('date',"Ymd");
        $upload->saveName = time()."_".mt_rand();
        $info = $upload->upload();

        if (!$info){
            $this->crmError($upload->getError());
        }else {
            $filenameArr = array();
            foreach ($info as $key => $val){
                $savepath = $val['savepath'];
                $savename = $val['savename'];
                $filename = "/Public/upload/".$savepath . $savename;
                $filenameArr[$key] = $filename;
            }
            return $filenameArr;
        }
    }   
}
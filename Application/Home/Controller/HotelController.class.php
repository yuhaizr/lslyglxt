<?php
namespace Home\Controller;

use Home\Model\HotelModel;

/**
 * 酒店管理
 * @author Administrator
 *
 */
class HotelController extends BaseController
{
    
    public function showList(){
        $searchValue = I('searchValue');
        $model = new HotelModel();
        $data = $model->showList($searchValue);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchValue',$searchValue);
        $this->display();
    }
    
    public function detail(){
        $hotel = M('Hotel');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $hotel->where($where)->find();
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }
    public function modify(){
        $hotel = M('Hotel');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $hotel->where($where)->find();
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
        $hotel = M('Hotel');
        $this->check($data);
        
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['cuid'] = $_SESSION['authId'];
        $res = $hotel->add($data);
        if ($res == false){
            $this->error('添加失败');
        }else{
            $this->success('添加成功','showList');
        }
        
    }
    
    public function save(){
        $id = I('id');
        $data = $_POST;
        $hotel = M('Hotel');
        $this->check($data);
        
        
        if (isset($id) && $id){
        
            $where['id'] = $id;
            $res = $hotel->where($where)->save($data);
             
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

        $scenicSpot = M('Hotel');

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
        if (isset($data['name']) && mbstrlen($data['name']) > 30 ){
            $this->error('酒店名称必须小于30字');
        }
        if (isset($data['intro']) && mbstrlen($data['intro']) > 300 ){
            $this->error('酒店概况必须小于300字');
        }
        if (isset($data['strategy']) && mbstrlen($data['strategy']) > 300 ){
            $this->error('酒店攻略必须小于300字');
        }   
        
        if ( isset($data['myear']) && (strtotime($data['myear']) < strtotime($data['cyear']))){
            $this->error('酒店创建年月必须早于最近维修年月');
        }
        if (  (strtotime($data['cyear']) > time())){
            $this->error('酒店创建年月必须早于当前时间');
        }    
        if (  (strtotime($data['myear']) > time())){
            $this->error('最近维修年月必须早于当前时间');
        }        

    }
    

    
    
}
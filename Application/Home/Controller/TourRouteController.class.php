<?php
namespace Home\Controller;

use Home\Model\TourRouteModel;
use Home\Model\ScenicSpotModel;
use Think\Model;


/**
 * 特产管理
 * @author Administrator
 *
 */
class TourRouteController extends BaseController
{
    
    public function showList(){
        $searchValue = I('searchValue');
        $model = new TourRouteModel();
        $data = $model->showList($searchValue);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchValue',$searchValue);
        $this->display();
    }
    
    public function detail(){
        $tour_route = M('Tour_route');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $tour_route->where($where)->find();
            
            $scenicSpot = new ScenicSpotModel();
            $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
            
            $this->assign('scenic_spot_list',$scenic_spot_list);
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }
    public function modify(){
        $tour_route = M('Tour_route');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            
            $scenicSpot = new ScenicSpotModel();
            $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
            
            $this->assign('scenic_spot_list',$scenic_spot_list);
        
            $info = $tour_route->where($where)->find();
            
            $model = new TourRouteModel();
            $info = $model->fixInfo($info);
            

            
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }   
    public function  add(){
        if ('menu' == I('type')){
            $scenicSpot = new ScenicSpotModel();
            $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
            
            $this->assign('scenic_spot_list',$scenic_spot_list);
            $this->display();exit();
        }
        $data = $_POST;
        $tour_route = M('Tour_route');
        $this->check($data);
        
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['cuid'] = $_SESSION['authId'];
        $res = $tour_route->add($data);
        if ($res == false){
            $this->error('添加失败');
        }else{
            $this->success('添加成功','showList');
        }
        
    }
    
    public function save(){
        $id = I('id');
        $data = $_POST;
        $tour_route = M('Tour_route');
        $this->check($data);
        
   
        if (isset($id) && $id){
        
            $where['id'] = $id;
            $res = $tour_route->where($where)->save($data);
             
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

         $tour_route = M('Tour_route');

        if (isset($id) && $id){
            $data['is_valid'] = '0';
            $where['id'] = $id;
            $res = $tour_route->where($where)->save($data);
             
            if ($res === false){
                $this->error('删除失败');
            }else{
                $this->success('删除成功','showList');
            }
        
        
        }else{
            $this->error('id 丢失');
        }
    }
    
    

  
    
    private function check($data){
        if (isset($data['name']) && mbstrlen($data['name']) > 30 ){
            $this->error('路线名称必须小于30字');
        }

    }
    

    
    
}
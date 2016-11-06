<?php
namespace Home\Controller;

use Home\Model\VisitorsModel;
use Home\Model\ScenicSpotModel;
use Think\Model;

/**
 * 特产管理
 * @author Administrator
 *
 */
class VisitorsController extends BaseController
{
    
    public function showList(){
        $searchDate = I('searchDate');
        $scenic_spot_id = I('scenic_spot_id');
        $model = new VisitorsModel();
        $data = $model->showList($scenic_spot_id,$searchDate);
        
        $scenicSpot = new ScenicSpotModel();
        $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
        
        $this->assign('scenic_spot_list',$scenic_spot_list);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchDate',$searchDate);
        $this->assign('scenic_spot_id',$scenic_spot_id);
        $this->display();
    }
    
    public function detail(){
        $visitors = M('Visitors');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            
            $scenicSpot = new ScenicSpotModel();
            $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
            $this->assign('scenic_spot_list',$scenic_spot_list);
            
            $info = $visitors->where($where)->find();
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }
    public function modify(){
        $visitors = M('Visitors');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            
            $scenicSpot = new ScenicSpotModel();
            $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
            $this->assign('scenic_spot_list',$scenic_spot_list);
            
            $info = $visitors->where($where)->find();
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
        $visitors = M('Visitors');
        
        $where['date'] = $data['date'];
        $where['is_valid'] = '1';
        $where['scenic_spot_id'] = $data['scenic_spot_id'];
        $info = $visitors->where($where)->find();
        if ($info){
            $this->error( $data['date'].'该景点已经添加过了');
        }
        $this->check($data);
        
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['cuid'] = $_SESSION['authId'];
        $res = $visitors->add($data);
        if ($res == false){
            $this->error('添加失败');
        }else{
            $this->success('添加成功','showList');
        }
        
    }
    
    public function save(){
        $id = I('id');
        $data = $_POST;
        $visitors = M('Visitors');
        $this->check($data);
        
        
        if (isset($id) && $id){
        
            $where['id'] = $id;
            $res = $visitors->where($where)->save($data);
             
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

        $visitors = M('Visitors');

        if (isset($id) && $id){
            $data['is_valid'] = '0';
            $where['id'] = $id;
            $res = $visitors->where($where)->save($data);
             
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
        if (isset($data['date']) && $data['date']){
            if (strtotime($data['date']) > time()){
                $this->error(" 添加日期不能大于当前日期");
            }
        }


    }
    
    
    public function countTotal(){
        $searchDate = I("searchDate");
        if (!isset($searchDate) || !$searchDate){
            $searchDate = date('Y-m-d')."__".date("Y-m-d");
        }
        
        $model = new VisitorsModel();
        $res = $model->countTotal($searchDate);
        $this->assign('legend',$res['legend']);
        $this->assign('data',$res['data']);
        $this->assign('searchDate',$searchDate);
        $this->display();
    }
    
    public function count(){
        
        $searchDate = I("searchDate");
        $scenic_spot_id = I('scenic_spot_id');
        
       if (!isset($searchDate) || !$searchDate){
            $searchDate = date('Y-m-d')."__".date("Y-m-d");
        }
        
        
        $scenicSpot = new ScenicSpotModel();
        $scenic_spot_list = $scenicSpot->getAllScenicSpotList();
        $this->assign('scenic_spot_list',$scenic_spot_list);
        $this->assign('scenic_spot_id',$scenic_spot_id);
        $model = new VisitorsModel();
        $res = $model->count($searchDate,$scenic_spot_id);
        $this->assign('legend',$res['legend']);
        $this->assign('data',$res['data']);
        $this->assign('searchDate',$searchDate);
        
        $this->display();
    }
    
    
}
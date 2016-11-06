<?php
namespace Home\Controller;

use Home\Model\CheckWorkModel;
use Home\Model\UserModel;
use Think\Model;

/**
 * 酒店管理
 * @author Administrator
 *
 */
class CheckWorkController extends BaseController
{
    
    public function showList(){
        $searchUid = I('searchUid');
        $searchDate = I('searchDate');
        $model = new CheckWorkModel();
        $data = $model->showList($searchUid,$searchDate);
        
        $userModel = new UserModel();
        $userList = $userModel->getUserListByRoleId("(1,2)", '1');
        

        $role_ids = $userModel->getRoleIdsByUserId($_SESSION['authId']);
        if (!in_array('1', $role_ids)){
            $this->assign('is_show','0');
        }else{
            $this->assign('is_show','1');
        }
        
        $this->assign('userList',$userList);
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchUid',$searchUid);
        $this->assign('searchDate',$searchDate);
        $this->display();
    }
    
    
    public function  add(){
        $model = M('Check_work');
        
        $where['uid'] = $_SESSION['authId'];
        $where['date'] = date('Y-m-d');
        $info = $model->where($where)->find();
        $this->assign('today',date('Y-m-d'));
        if (isset($info['starttime']) && $info['starttime']){
            $this->assign('starttime',$info['starttime']);
        }else{
            $this->assign('starttime','0');
        }
        if (isset($info['endtime']) && $info['endtime']){
            $this->assign('endtime',$info['endtime']);
        }else{
            $this->assign('endtime','0');
        } 
        $this->display();
        
    }
    
    public function save(){
        $model = M('Check_work');
        $detype = I('detype');
        $where['uid'] = $_SESSION['authId'];
        $where['date'] = date('Y-m-d');
        $info = $model->where($where)->find();


        if ($detype == 'starttime'){
            
            if (isset($info['starttime']) && $info['starttime']){
                $this->error("上班已考勤");
            }
            $data = $where;
            $data['starttime'] = date('Y-m-d H:i:s');
            if ($info){
                $res = $model->where($where)->save($data);
            }else {
                $res = $model->add($data);
            }
            
            if ($res === false){
                $this->error("上班考勤失败");
            }else{
                $this->success("上班考勤成功","add");
            }
        }else {
            if (isset($info['endtime']) && $info['endtime']){
                $this->error("下班已考勤");
            }
            $data = $where;
            $data['endtime'] = date('Y-m-d H:i:s');
                    if ($info){
                $res = $model->where($where)->save($data);
            }else {
                $res = $model->add($data);
            }
            
            if ($res === false){
                $this->error("下班考勤失败");
            }else{
                $this->success("下班考勤成功","add");
            }
        }
        
        
        
    }
    
    
    
    

    
    
}
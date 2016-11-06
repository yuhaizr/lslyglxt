<?php
namespace Home\Model;

use Think\Page;
use Think\Model;
class CheckWorkModel extends BaseModel
{
    /**
     * 
     */
    public function showList($searchUid,$searchDate){

       
        $paramer = array(
            'searchUid' => $searchUid,
            'searchDate' => $searchDate,
        );
        
        $model = M('Check_work');
        $where = array();
        if($searchDate){
            $time_rane = fix_range_date($searchDate);
            $where['date'] = array(array('EGT',$time_rane['start_date']),array('ELT',$time_rane['end_date'])) ;
        }
        
  
        $userModel = new UserModel();
        $role_ids = $userModel->getRoleIdsByUserId($_SESSION['authId']);
        if (!in_array('1', $role_ids)){
            $where['uid'] = $_SESSION['authId'];
        }
        
        if (isset($searchUid) && $searchUid){
            $where['uid'] = $searchUid;
        }
        
        $where['is_valid'] = '1';
  
        
      
        $total = $model->where($where)->count();
        
        $page = new Page($total,20,$paramer);
        $show = $page->show();
        $list = $model
        ->where($where)
        ->order(' date DESC ')
        ->limit($page->firstRow, $page->listRows)
        ->select();
        $list = $this->fixList($list);
        return array(
            'list' => $list,
            'page' => $show,
        );
    }
    
    private function fixList($list){
        $userModel = M('User');
        if (is_array($list)){
            foreach ($list as $key => &$val){

                $where['id'] = $val['uid'];
                $info = $userModel->where($where)->find();
                $val['account'] = $info['account'];
                $val['nickname'] = $info['nickname'];
            }
            
        }
        
        return $list;
    }
}
<?php
namespace Home\Model;

use Think\Page;
class SuggestionModel extends BaseModel
{
    /**
     * 
     */
    public function showList($searchValue){

        $paramer = array(
            'searchValue' => $searchValue,
        );
        
        $model = M('Suggestion');
        $where = array();
        
        $userModel = new UserModel();
        $role_ids = $userModel->getRoleIdsByUserId($_SESSION['authId']);
        if (!in_array('1', $role_ids) && !in_array('2', $role_ids)){
            $where['cuid'] = $_SESSION['authId'];
        }
        
        $where['is_valid'] = '1';
        if ($searchValue){
            $where['_string'] = " content LIKE  '%".$searchValue."%' ";
        }
        
      
        $total = $model->where($where)->count();
        
        $page = new Page($total,20,$paramer);
        $show = $page->show();
        $list = $model
        ->where($where)
        ->order(' ctime DESC ')
        ->limit($page->firstRow, $page->listRows)
        ->select();
        $list = $this->fixList($list);
        return array(
            'list' => $list,
            'page' => $show,
        );
    }
    
    private function fixList($list){
        $userModel = M("User");
        if (is_array($list)){
            foreach ($list as $key => &$val){                
                $where['id'] = $val['cuid'];
                $info = $userModel->where($where)->find();
                $val['account'] = $info['account'];
                $val['nickname'] = $info['nickname'];
            }
            
        }
        
        return $list;
    }
}
<?php
namespace Home\Model;

use Think\Page;
class ScenicSpotModel extends BaseModel
{
    /**
     * 
     */
    public function scenicSpotList($searchValue){

        $paramer = array(
            'searchValue' => $searchValue,
        );
        
        $scenicSpot = M('ScenicSpot');
        $where = array();
        $where['is_valid'] = '1';

        if ($searchValue){
            $where['_string'] = " name LIKE  '%".$searchValue."%'";
        }
        
        $total = $scenicSpot->where($where)->count();
        
        $page = new Page($total,20,$paramer);
        $show = $page->show();
        $list = $scenicSpot
        ->where($where)
        ->order(' ctime DESC ')
        ->limit($page->firstRow, $page->listRows)
        ->select();
        $list = $this->fixScenicSpotList($list);
        return array(
            'list' => $list,
            'page' => $show,
        );
    }
    
    private function fixScenicSpotList($list){
        
        if (is_array($list)){
            foreach ($list as $key => &$val){
                if (mbstrlen($val['intro']) > 60){
                    $val['intro'] = msubstr($val['intro'], 0,60)."...";
                }else{
                    $val['intro'] = msubstr($val['intro'], 0,60);
                }
                if (mbstrlen($val['traffic']) > 60){
                    $val['traffic'] = msubstr($val['traffic'], 0,60)."...";
                }else{
                    $val['traffic'] = msubstr($val['traffic'], 0,60);
                }
                if (mbstrlen($val['ticket']) > 60){
                    $val['ticket'] = msubstr($val['ticket'], 0,60)."...";
                }else{
                    $val['ticket'] = msubstr($val['ticket'], 0,60);
                }
                
            }
            
        }
        
        return $list;
    }
    
    
    public function getAllScenicSpotList(){
        $where = array();
        $where['is_valid'] = '1';
        $scenicSpot = M('ScenicSpot');
        $list = $scenicSpot
        ->where($where)
        ->order(' ctime DESC ')
        ->select();
        
        
        return $list;
    }
    
    
}
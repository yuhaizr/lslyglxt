<?php
namespace Home\Model;

use Think\Page;
class LocalProductModel extends BaseModel
{
    /**
     * 
     */
    public function showList($searchValue){

        $paramer = array(
            'searchValue' => $searchValue,
        );
        
        $model = M('Local_product');
        $where = array();
        $where['is_valid'] = '1';
        if ($searchValue){
            $where['_string'] = " name LIKE  '%".$searchValue."%' OR best_produc_area LIKE '%{$searchValue}%'";
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
        
        if (is_array($list)){
            foreach ($list as $key => &$val){
                if (mbstrlen($val['intro']) > 60){
                    $val['intro'] = msubstr($val['intro'], 0,60)."...";
                }else{
                    $val['intro'] = msubstr($val['intro'], 0,60);
                }

                if (mbstrlen($val['best_produc_area']) > 60){
                    $val['best_produc_area'] = msubstr($val['best_produc_area'], 0,60)."...";
                }else{
                    $val['best_produc_area'] = msubstr($val['best_produc_area'], 0,60);
                }
                
                
            }
            
        }
        
        return $list;
    }
}
<?php
namespace Home\Model;

use Think\Page;
class TourRouteModel extends BaseModel
{
    /**
     * 
     */
    public function showList($searchValue){

        $paramer = array(
            'searchValue' => $searchValue,
        );
        
        $model = M('Tour_route');
        $where = array();
        $where['is_valid'] = '1';
        if ($searchValue){
            $where['_string'] = " name LIKE  '%".$searchValue."%' ";
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
  
        $scenic_spot = M("Scenic_spot");
        if (is_array($list)){
            foreach ($list as $key => &$val){
                if (mbstrlen($val['reason']) > 60){
                    $val['reason'] = msubstr($val['reason'], 0,60)."...";
                }else{
                    $val['reason'] = msubstr($val['reason'], 0,60);
                }
                
                if (isset($val['scenic_spot_list']) && $val['scenic_spot_list']){
                    $scenic_spot_list = split(",", $val['scenic_spot_list']);
                    $namelist = '';
                   
                    if (is_array($scenic_spot_list)){
                        foreach ($scenic_spot_list as $k => $v){
                            $where['id'] = $v;
                            $info =  $scenic_spot->where($where)->find();
                            
                            $namelist .= ",".$info['name'];
                        }
                    }
                    $namelist = trim($namelist,',');
                    $val['scenic_spot_list'] = $namelist;
            
                }
   
                
            }
            
        }
        
        return $list;
    }
    
    
    public function fixInfo($info){
            $scenic_spot = M("Scenic_spot");
            if (isset($info['scenic_spot_list']) && $info['scenic_spot_list']){
                $scenic_spot_list = split(",", $info['scenic_spot_list']);
      
                $info['scenic_spot_list'] = $scenic_spot_list;
            
            }
            return $info;
    }
    

}
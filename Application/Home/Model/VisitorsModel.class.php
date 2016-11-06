<?php
namespace Home\Model;

use Think\Page;
use Think\Model;
class VisitorsModel extends BaseModel
{
    /**
     * 
     */
    public function showList($scenic_spot_id,$searchDate){

        $paramer = array(
            'scenic_spot_id' => $scenic_spot_id,
            'searchDate' => $searchDate,
        );
        
        $model = M('Visitors');
        $where = array();
        if($searchDate){
            $time_rane = fix_range_date($searchDate);
            $where['date'] = array(array('EGT',$time_rane['start_date']),array('ELT',$time_rane['end_date'])) ;
        }
        $where['is_valid'] = '1';
        if ($scenic_spot_id){
            $where['_string'] = " scenic_spot_id = ".$scenic_spot_id." ";
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
        $scenic_spot = M('Scenic_spot');
        if (is_array($list)){
            foreach ($list as $key => &$val){
                
                $where['id'] = $val['scenic_spot_id'];
                $info = $scenic_spot->where($where)->find();
                
                $val['scenic_spot_id'] = $info['name'];

                
            }
            
        }
        
        return $list;
    }
    
    public function countTotal($searchDate){
        
     
         $time_rane = fix_range_date($searchDate);
         $start_date = $time_rane['start_date'];
         $end_date = $time_rane['end_date'];
         $scenicSpotList = new ScenicSpotModel();
         $scenicSpotList = $scenicSpotList->getAllScenicSpotList();
         
         $model = M('Visitors');
         $where = array();
         $where['date'] = array(array('EGT',$time_rane['start_date']),array('ELT',$time_rane['end_date']));
         $where['is_valid'] = '1';
         $legend = array();
         $data = array();
         if (is_array($scenicSpotList)){
             foreach ($scenicSpotList as $key => $val){
                 $legend[] = $val['name'];
                 $where['scenic_spot_id'] = $val['id'];
             
                 $num = intval($model->where($where)->sum('totalnum'));
                 $info = array('value'=>$num,'name'=>$val['name']);
                 $data[] = $info;
             }            
         }

        $legend = json_encode($legend);
        $data = json_encode($data);
        
        return array('legend'=>$legend,'data'=>$data);
        
    }
    
    public function count($searchDate,$scenic_spot_id){
        $time_rane = fix_range_date($searchDate);
        $start_date = $time_rane['start_date'];
        $end_date = $time_rane['end_date'];
        

        
        $model = M('Visitors');
        $where = array();
       // $where['date'] = array(array('EGT',$time_rane['start_date']),array('ELT',$time_rane['end_date']));
        if (isset($scenic_spot_id) && $scenic_spot_id){
            $where['scenic_spot_id'] = $scenic_spot_id;
        }
        $where['is_valid'] = '1';
        $legend = array();
        $data = array();
        
        while (strtotime($start_date) <= strtotime($end_date)){
            $legend[] = $start_date;
            $where['date'] = $start_date;
            $num = intval($model->where($where)->sum('totalnum'));
            $data[] = $num;
            
            $start_date = date("Y-m-d",strtotime($start_date) + 24*60*60);
        }
        
        $legend = json_encode($legend);
        $data = json_encode($data);
        
        return array('legend'=>$legend,'data'=>$data);
    }
    
}
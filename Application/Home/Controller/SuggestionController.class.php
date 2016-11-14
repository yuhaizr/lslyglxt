<?php
namespace Home\Controller;

use Home\Model\SuggestionModel;
use Think\Model;

/**
 * 意见反馈管理
 * @author Administrator
 *
 */
class SuggestionController extends BaseController
{
    
    public function showList(){
        $searchValue = I('searchValue');
        $model = new SuggestionModel();
        $data = $model->showList($searchValue);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchValue',$searchValue);
        $this->display();
    }
  
    public function  add(){
        if ('menu' == I('type')){
            $this->display();exit();
        }
        $data = $_POST;
        $suggestion = M('Suggestion');
        $this->check($data);
        
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['cuid'] = $_SESSION['authId'];
        $res = $suggestion->add($data);
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


    private function check($data){
        if (isset($data['content']) && mbstrlen($data['content']) < 10 ){
            $this->error('反馈意见必须大于10字');
        }
        if (isset($data['content']) && mbstrlen($data['content']) > 200 ){
            $this->error('反馈意见必须小于200字');
        } 

    }
    

    
    
}
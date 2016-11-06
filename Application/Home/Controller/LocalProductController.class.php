<?php
namespace Home\Controller;

use Home\Model\LocalProductModel;
use Think\Model;

/**
 * 特产管理
 * @author Administrator
 *
 */
class LocalProductController extends BaseController
{
    
    public function showList(){
        $searchValue = I('searchValue');
        $model = new LocalProductModel();
        $data = $model->showList($searchValue);
        
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->assign('searchValue',$searchValue);
        $this->display();
    }
    
    public function detail(){
        $local_product = M('Local_product');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $local_product->where($where)->find();
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }
    public function modify(){
        $local_product = M('Local_product');
        $id = I('id');
        if (isset($id) && $id){
            $where['id'] = $id;
            $info = $local_product->where($where)->find();
            $this->assign('info',$info);
        }else{
            $this->error('id缺失');
        }
        $this->display();
    }   
    public function  add(){
        if ('menu' == I('type')){
            $this->display();exit();
        }
        $data = $_POST;
        $local_product = M('Local_product');
        $this->check($data);
        
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['cuid'] = $_SESSION['authId'];
        $res = $local_product->add($data);
        if ($res == false){
            $this->error('添加失败');
        }else{
            $this->success('添加成功','showList');
        }
        
    }
    
    public function save(){
        $id = I('id');
        $data = $_POST;
        $local_product = M('Local_product');
        $this->check($data);
        
        
        if (isset($id) && $id){
        
            $where['id'] = $id;
            $res = $local_product->where($where)->save($data);
             
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

        $local_product = M('Local_product');

        if (isset($id) && $id){
            $data['is_valid'] = '0';
            $where['id'] = $id;
            $res = $local_product->where($where)->save($data);
             
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
            $this->error('特产名称必须小于30字');
        }
        if (isset($data['intro']) && mbstrlen($data['intro']) > 300 ){
            $this->error('特产概况必须小于300字');
        }


    }
    

    
    
}
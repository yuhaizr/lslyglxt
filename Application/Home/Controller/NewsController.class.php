<?php
namespace Home\Controller;

use Home\Model\NewsModel;
/**
 * 
 * @author Administrator
 *
 */
class NewsController extends BaseController
{
    //获取资讯列表
    public function newsList(){
        $title = I('title');
        $content = I('content');
        $news = new NewsModel();
        $list = $news->getNewsList();
        
        $this->assign('title',$title);
        $this->assign('content',$content);
        $this->assign('list',$list);
        
        $this->display();
        

     
    }
    //添加资讯
    public function addNews(){
        $title = I('title');
        $content = I('content');
        
        if(!isset($title) || !$title){
            $this->error('资讯标题缺失');
        }
        if (!isset($content) || !$content){
            $this->error('文章内容必填');
        }
        $data['title'] = $title;
        $data['content'] = $content;
        $data['cuid'] = $_SESSION['authId'];
        $data['ctime'] = date('Y-m-d H:i:s');
        
        $news = M('News');
        $res = $news->add($data);
        if ($res === false){
            $this->error('添加失败');
        }else{
            $this->success('添加成功','News/newList');
            
        }
        
        
    }
    
}
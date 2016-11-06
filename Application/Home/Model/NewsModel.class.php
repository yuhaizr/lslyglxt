<?php
namespace Home\Model;

use Think\Page;
/**
 * 资讯model
 * @author Administrator
 *
 */
class NewsModel extends BaseModel
{
    /**
     * 获取资讯列表
     */
    public function getNewsList($title,$content){
        
        
        $where = array();
        $paramer = array(
            'title' => $title,
            'content' => $content,
        );
        
        if ($title){
            $where['title'] = array('like',array("%{$title}%"),"AND");
        }
        if ($content){
            $where['content'] = array('like',array("%{$content}%"),"AND");
        }        
        
        $news = M('News');
        
        $total = $news->where($where)->count();
        
        $page = new Page($total,20,$paramer);
        
        $show = $page->show();
        
        $list = $news->where($where)
        ->order(' id DESC ')
        ->limit($page->firstRow, $page->listRows)
        ->select();
        
        $list = $this->fix_news($list);
        
        
        return array(
            'list' => $list
           ,'page' => $show
        );
        
        
    }
    
    public function fix_news($list){
        if (is_array($list) && $list){
            foreach ($list as $key => &$val){
                $val['cdate'] = date('Y-m-d',strtotime($val['ctime']));
            }
        }
        
        return $list;
    }
    
}
<?php
namespace Behavior;

class FlashBehaviors
{
	/* (non-PHPdoc)
     * @see \Think\Behavior::run()
     */
    public function run (&$params)
    {
                
    }
    
    public function app_init(&$params)
    {
        $shutdown = function (){
            $list = session('__FALSHDATA__');
            if ($list && (null != ($list = json_decode($list)))) {
                foreach ($list as $k) {
                    session($k,null);
                }
            }
            
            $flashdata = null;
            $list = \Org\Util\FlashData::getList();
            if ($list) {
                $flashdata = json_encode($list);
            }
            session('__FALSHDATA__', $flashdata);
        };
        
        register_shutdown_function($shutdown);
        
        
    }

    
}

?>
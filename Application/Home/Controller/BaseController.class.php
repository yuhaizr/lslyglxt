<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\Rbac;
use Org\Util\FlashData;
use Home\Model\LogModel;
use Home\Model\TaskModel;

class BaseController extends Controller
{

    public function __construct ()
    {
        parent::__construct();
        // $self_url = $_SERVER['PHP_SELF'];
        $this->saveLog();
    }

    public function saveLog ()
    {
    	// $self_url = str_replace("index.php/", "", $self_url);
    	// $self_url = ltrim($self_url,"/");
    	// module 业务名称 action 业务模块 function 操作
    	// list (,$module, $action,$function) = explode('/', $self_url);
    	$module = MODULE_NAME;
    	$action = CONTROLLER_NAME;
    	$function = ACTION_NAME;
    
    	$this->getNowPath();
    
    
    	

    }
    private function getNowPath ()
    {
        $module = MODULE_NAME;
        $action = CONTROLLER_NAME;
        $function = ACTION_NAME;
        
        if (\Org\Util\Rbac::check('modify',$action,$module)){
            $this->assign('my_modify_btn','1');
        }else {
            $this->assign('my_modify_btn','0');
        }
        if (\Org\Util\Rbac::check('del',$action,$module)){
            $this->assign('my_del_btn','1');
        }else {
            $this->assign('my_del_btn','0');
        }        

        
        $NOW_MENU = "/{$module}/$action/$function";
        $list = C('MENU');
        
        $res = $this->get_now_menu($NOW_MENU, $list);
        if (isset($res['SECOND_NOW_MENU']) && $res['SECOND_NOW_MENU']) {
            $this->assign('SECOND_NOW_MENU', $res['SECOND_NOW_MENU']);
        }
        if (isset($res['NOW_MENU']) && $res['NOW_MENU']) {
            $this->assign('NOW_MENU', $res['NOW_MENU']);
        }
        
        $node = M("Node");
        $moduleres = $node->where(" name like '" . $module . "'  AND level ='1' ")->find();
        $module = $moduleres['title'];
        
        if (isset($moduleres['id']) && $moduleres['id']){
            
            $resaction = $node->where(" name like '" . $action . "'  AND pid={$moduleres['id']}  AND level ='2' ")->find();
            $action = $resaction['title'];
            
            if (isset($resaction['id']) && $resaction['id']){
                $function = $node->where(" name like '" . $function . "' AND pid={$resaction['id']} AND level ='3' ")->find();
                $function = $function['title'];
            }else{
                $function = '';
            }
            
        }else {
            $action = '';
            $function = '';
        }
        
        
        
        
        $this->assign('NOW_PATH', $module . " / " . $action . " / " . $function);
        $this->assign('page_title', $function);
        
        
        
        
    }

    private function get_now_menu ($NOW_MENU, $list)
    {
        $flag = false;
        $res = array();
        foreach ($list as $key => $val) {
            if (isset($val['childs']) && $val['childs']) {
                
                $childs = $val['childs'];
                foreach ($childs as $k => $v) {
                    if (isset($v['childs']) && $v['childs']) {
                        $res = $this->get_now_menu($NOW_MENU,
                                array(
                                        $v
                                ));
                        if ($res) {
                            $res['SECOND_NOW_MENU'] = $res['NOW_MENU'];
                            $res['NOW_MENU'] = $val['link'];
                            return $res;
                        }
                    } else {
                        
                        $link = $v['link'];
                        if (strstr($link, $NOW_MENU)) {
                            $res['NOW_MENU'] = $val['link'];
                            return $res;
                        }
                    }
                }
            } else {
                $res['NOW_MENU'] = $val['link'];
                return $res;
            }
            if ($flag) {
                break;
            }
        }
        
        return $res;
    }

    public function _initialize ()
    {
        // 用户权限检查
        if (C('USER_AUTH_ON') &&
                 ! in_array(CONTROLLER_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            if (! $_SESSION[C('USER_AUTH_KEY')]) {
                // 跳转到认证网关
                if (C('IS_MAIN_COPY')) {
                    redirect(C('MAIN_SITEURL') . C('USER_AUTH_GATEWAY'));
                } else {
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
            } else {
                if (! \Org\Util\Rbac::AccessDecision()) {
                    // 没有权限 抛出错误
                    if (C('RBAC_ERROR_PAGE')) {
                        // 定义权限错误页面
                        redirect(C('RBAC_ERROR_PAGE'));
                    } else {
                        if (C('GUEST_AUTH_ON')) {
                            $this->assign('jumpUrl',
                                    PHP_FILE . C('USER_AUTH_GATEWAY'));
                        }
                        // 提示错误信息
                        $this->error(L('_VALID_ACCESS_'));
                    }
                }
            }
        }
        //获取菜单信息
        $this->menu();

    }



    /**
     * 取证书KEY
     *
     * @param <type> $cert
     * @return <type>
     */
    protected function get_cert_md5 ($cert)
    {
        $cert = str_replace("\n", "", $cert);
        $cert = str_replace("-----BEGIN CERTIFICATE-----", "", $cert);
        $cert = str_replace("-----END CERTIFICATE-----", "", $cert);
        return strtoupper(md5(base64_decode($cert)));
    }

    protected function crmSuccess ($message, $url = '')
    {
        $this->_flashRediect($message, 'success', $url);
    }

    protected function crmError ($message, $url = '')
    {
        $this->_flashRediect($message, 'error', $url);
    }

    private function _flashRediect ($message = '', $type = 'success', $url = '')
    {
        FlashData::flash('__SYS_MESSAGE__', $message);
        FlashData::flash('__SYS_MESSAGE_TYPE__', $type);
        
        if (empty($url)) {
            $url = $_SERVER['HTTP_REFERER'];
        }
        
        redirect($url);
    }

    /**
     * 生成菜单
     * 从配置文件中取出菜单的数组
     * 查看这个数组是否存在childs元素
     * 如果存在childs元素则用这个数组与当前用户允许的访问的模块和操作进行匹配
     * 如果匹配到了就把其放入menu数组中去
     * 如果不存在childs则根据link来切割获取module和action
     * 并判断其是否在允许访问的列表中，如果在则将其允许访问的标志放入menu中去
     */
    protected function menu ()
    {
    	$a = $_SESSION;
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            // 显示菜单项
            $menu = array();
            if (isset($_SESSION['menu1' . $_SESSION[C('USER_AUTH_KEY')]])) {
                // 如果已经缓存，直接读取缓存
                // $menu = $_SESSION['menu' . $_SESSION[C('USER_AUTH_KEY')]];
            } else {
                $list = C('MENU');
                if (isset($_SESSION['_ACCESS_LIST'])) {
                    // $accessList = $_SESSION['_ACCESS_LIST'];
                    $accessList = Rbac::getAccessList(
                            $_SESSION[C('USER_AUTH_KEY')]);
                } else {
                    $accessList = Rbac::getAccessList(
                            $_SESSION[C('USER_AUTH_KEY')]);
                }
                // var_dump($accessList);exit();
                $menu = $this->get_menu($list, $accessList);
                // $_SESSION['menu' . $_SESSION[C('USER_AUTH_KEY')]] = $menu;
            }
            // var_dump($menu);exit();
            $this->assign('menu', $menu);
        }
    }

    private function get_menu ($list, $accessList)
    {
        // 显示菜单项
        $menu = array();
        foreach ($list as $key => $value) {
            if (isset($value['childs'])) {
                $childs = array();
                foreach ($value['childs'] as $k => $v) {
                    if (isset($v['childs']) && $v['childs']) {
                        
                        $link = $v['link'];
                        list (, $module_c, $action_c) = explode('/', $link);
                        
                        if ((isset($accessList[strtoupper($module_c)][strtoupper($action_c)])
                                ||isset($_SESSION['super_admin']))) {
                            
                            $res = $this->get_menu($v['childs'],
                                    $accessList);
                            if (isset($res) && $res) {
                                $v['childs'] = $res;
                                $v['access'] = 1;
                                $childs[$k] = $v;
                            }
                          
                        }
                    } else {
                        $link = $v['link'];
                        if (preg_match_all(
                                "/^\/([\w]+[^\/])\/([\w]+[^\/])\/([\w]+[^\/|\?])/",
                                $link, $matches)) {
                            $module = $matches[1][0];
                            $action = $matches[2][0];
                            $function = $matches[3][0];
                            if (isset(
                                    $accessList[strtoupper($module)][strtoupper(
                                            $action)][strtoupper($function)]) ||
                                     isset($_SESSION['super_admin'])) {
                                // 设置模块访问权限
                                $v['access'] = 1;
                                $childs[$k] = $v;
                            }
                        }
                    }
                }
                if (! empty($childs)) {
                    $value['access'] = 1;
                    $value['childs'] = $childs;
                    $menu[$key] = $value;
                }
            } else {
                $link = $value['link'];
                list (, $module, $action,$function) = explode('/', $link);
                
                if (isset($function)&&$function){
                    list($function) = explode('?', $function);
                    
                    if (isset($accessList[strtoupper($module)][strtoupper($action)][strtoupper($function)]) ||
                            isset($_SESSION['administrator'])) {
                                $value['access'] = 1;
                                $menu[$key] = $value;
                            }
                }else {
                    if (isset($accessList[strtoupper($module)][strtoupper($action)]) ||
                            isset($_SESSION['administrator'])) {
                                $value['access'] = 1;
                                $menu[$key] = $value;
                            }
                }

            }
        }
        
        return $menu;
    }
}

?>
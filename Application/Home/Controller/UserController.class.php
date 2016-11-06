<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;
use Org\Util\Rbac;
use Think\Model;

class UserController extends BaseController
{
    /**
     * 用户管理页面
     * 
     */
    public function userList(){
    	
    	$role_id = I('role_id');
    	$nickname = I('nickname');
        $type = I('type');
    	
     	$user = new UserModel();
     	$data = $user->get_user_list($role_id,$nickname);
     	
     	if ('searchUserList' == $type){
     	    $data = json_encode($data);
     	    echo $data;
     	    exit();
     	}
     	$userinfodata = $data['data'];

       
        $role = M('Role');

        $show = $data['show'];
        $roleList = $role->where(array('status'=>'1'))->select();
        $role_select[$role_id] = " selected = 'selected' ";
        $this->assign('role_select',$role_select);
        $this->assign('userinfolist',$userinfodata);
        $this->assign('roleList',$roleList);
        $this->assign('nickname',$nickname);
        $this->assign('role_id',$role_id);

        $this->assign('page',$show);
        $this->display();
    }
    
    /**
     * 新增用户
     * 
     */
    public function useradd(){
        if ('POST' == I('server.REQUEST_METHOD')) {
            $User = M('User');
            $a = $_POST;
            


            $data['password'] = I('password');
            $data['account'] = I('account');
            $data['remark'] = I('remark');
            $data['nickname'] = I('nickname');
            $data['status'] = I('status');
            $data['last_login_ip'] = get_client_ip();

            $this->check($data);
            $data['password'] = md5(I('password'));
            
            
            $userModel = new UserModel();
            $result = $userModel->getByAccount($data['account']);
            if ($result) {
                $this->error('该用户名已经存在！');
            }
            
            
            $result = $User->add($data);
            if($result){
                $this->success('添加成功', 'userList');
            }else{
                $this->error('添加失败');
            }
      
            
        }else{


            $user_list = $this->get_user_list();
            
   
            $this->assign('user_list',$user_list);

            $this->display();
        }   
    }
    
    /**
     * 通过user_id 获取他的 level
     * @param unknown $user_id
     */
    private function get_level($user_id){
        $user  = M('User');
        $where['id'] = $user_id;
        $member = $user->where($where)->select();
        if($member){
            return $member[0]['level'];
        }else {
            return -1;
        }
    }
    
    private function get_user_list(){
        $user = M('User');
        $userlist = array();
        $list = $user->select();
        if(is_array($list)){
            foreach ($list as $k => $v){
                $id = $v['id'];
                $nickname = $v['nickname'];
                $userlist[$id] = $nickname;
            }
        }
        
        return $userlist;
    } 
    
    private  function get_dept_list(){
        $dept = M('Dept');
        $dept_list = array();
        $dept_where['isDepete'] = '0';
        $list = $dept->where($dept_where)->select();
        if(is_array($list)){
            foreach ($list as $k => $v){
                $id = $v['id'];
                $dName = $v['dname'];
                $dept_list[$id] = $dName;
            }
        }
        
        return $dept_list;
    }
    
    /**
     * 修改用户信息
     * 
     */
    public function useredit(){
        $User = M('User');
        if ('POST' == I('server.REQUEST_METHOD')) {
            $data = $_POST;
            if ((isset($data['oldpassword']) && $data['oldpassword'])
                ||(isset($data['password']) && $data['password'])
                ){
                     if (!$data['oldpassword'] || !$data['password']){
                         $this->error('修改密码时必须填写原密码和新密码',"useredit?id={$data['id']}");
                     }else{
                         
                        $this->check($data);
                         
                         $userinfo = $User->where(array('id'=>$data['id']))->find();
                         if ($userinfo['password'] !== md5($data['oldpassword'])){
                             $this->error('原密码错误',"useredit?id={$data['id']}");
                         }
                         
                     }
                    
                     $data['password'] = md5($data['password']);
                }else {
                    unset($data['password']);
                }
            
             unset($data['oldpassword']);
            $res = $User->where(array('id'=>$data['id']))->save($data);
            if(false !== $res){
                $this->crmSuccess('编辑成功');
            }else{
                $this->crmError('编辑失败');
            }
        }else{
            $id = I('get.id');
            $userinfo = $User -> where("id=$id")->find();
            $role = M("Role");
            $roleList = $role->where(array('status'=>'1'))->select();
            $this->assign('roleList',$roleList);
            $this->assign('userinfo',$userinfo);
            $this->assign('userid',$id);
            $this->display();
        }
    }
    
    
    public function check($data){
        if (mbstrlen($data['password']) < 6 || mbstrlen($data['password']) > 10){
            $this->error("密码长度必须在6到10位之间");
        }
         
        if ( mbstrlen($data['nickname']) > 30){
            $this->error("昵称必须小于30个字");
        }
        if (mbstrlen($data['account']) < 5 || mbstrlen($data['account']) > 20){
            $this->error("账号必须小于20个字大于5个字");
        }
    }
    
    /**
     * 删除用户
     * 
     */
    public function userdelete(){
        $User = M('User');
        $id = I('get.id');
        $deleteStatus = $User -> where("id=$id") -> delete();
        if($deleteStatus){
            $this->success('删除成功');
       }else{
            $this->error('删除失败');
        }
    }
    /**
     * 检查帐号
     * 
     */
    public function checkAccount ()
    {
        if (! preg_match('/^[a-z]\w{4,}$/i', $_POST['account'])) {
            $this->error('用户名必须是字母，且5位以上！');
        }
        $User = M("User");
        // 检测用户名是否冲突
        $name = $_REQUEST['account'];
        $result = $User->getByAccount($name);
        if ($result) {
            $this->error('该用户名已经存在！');
        } else {
            $this->success('该用户名可以使用！');
        }
    }
    
    public function modPass(){
        
        $type = I('type');
        $oldpass = I('oldpass');
        $newpass = I('newpass');
        
        if('menu' == $type){
            $this->display();
            exit();
        }
        
        
        // 生成认证条件
        $map = array();
        // 支持使用绑定帐号登录
        $ses = $_SESSION;
        $map['account'] = $_SESSION['login_count'];
        $map["status"] = array(
                'gt',
                0
        );
        $authInfo = Rbac::authenticate($map);
        // 使用用户名、密码和状态的方式进行认证
        if (false === $authInfo) {
            $this->error('帐号不存在或已禁用！');
        } else {
            if ($authInfo['password'] != md5($oldpass)) {
                echoJson('1', '原密码输入错误');
            }else {
                $where['id'] = $_SESSION['authId'];
                $passdata['password'] = md5($newpass);
                $user = M('User');
                $res = $user->where($where)->save($passdata);
                if($res){
                    echoJson('0', '密码修改成功') ;
                }else {
                    echoJson('1', ' 服务器忙');
                }
            }
      
        }
        
        
    }
    
}
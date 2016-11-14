<?php
namespace Home\Controller;

use Think\Controller;
use Org\Util\Rbac;
use Think\Model;
use Home\Model\UserModel;

class LoginController extends Controller
{
    public function index ()
    {
        if (isset($_SERVER['SSL_CLIENT_CERT'])) {
            $cert = $_SERVER['SSL_CLIENT_CERT'];
            $cert = get_cert_md5($cert);
 
        } else {
            C('SHOW_RUN_TIME', false); // 运行时间显示
            C('SHOW_PAGE_TRACE', false);
            $this->display();
        }
    }

    public function checkLogin ()
    {
        $username = I('post.account');
        $userpswd = I('post.password');
        if (empty($username)) {
            $this->error('用户名不能为空', U('index'));
        }
        if (empty($userpswd)) {
            $this->error('密码不能为空', U('index'));
        }
        // 生成认证条件
        $map = array();
        // 支持使用绑定帐号登录
        $map['account'] = $username;
        $map["status"] = array(
                'gt',
                0
        );
        
        $authInfo = Rbac::authenticate($map);
        // 使用用户名、密码和状态的方式进行认证
        if (false === $authInfo) {
            $this->error('帐号不存在或已禁用！');
        } else {
            if ($authInfo['password'] != md5($userpswd)) {
                $this->error('密码错误', U('index'));
            }
            $this->dologin($authInfo);
        }
    }
    private function dologin (array $authInfo)
    {
        $_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];
      //  $_SESSION['email'] = $authInfo['email'];
        $_SESSION['loginUserName'] = $authInfo['nickname'];
        $_SESSION['lastLoginTime'] = $authInfo['last_login_time'];
        $_SESSION['login_count'] = $authInfo['account'];
        //$_SESSION['token_auth'] = $authInfo['token_auth'];
        if ($authInfo['account'] == 'super_admin') {
            $_SESSION[C('ADMIN_AUTH_KEY')] = true;
        }
        // 保存登录信息
        $User = M('User');
        $ip = get_client_ip();
        $time = date('Y-m-d H:i:s');
        $data = array();
        $data['id'] = $authInfo['id'];
        $data['last_login_time'] = $time;
        $data['login_count'] = $data['login_count']+1;
        $data['last_login_ip'] = $ip;
        $User->save($data);
        // 缓存访问权限
        Rbac::saveAccessList();
        $this->success('登录成功',__APP__.'/Home/Index/index');
    }

    public function logout ()
    {
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！', __APP__ . '/Home/Login/index');
        } else {
            $this->error('已经登出！');
        }
    }

    public function password ()
    {
        $this->display();
    }

    // 检查用户是否登录
    protected function checkUser ()
    {
        if (! isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('没有登录！', 'Public/login');
        }
    }

    public function changePwd ()
    {
        $this->checkUser();
        // 对表单提交处理进行处理或者增加非表单数据
        $map = array();
        $map['password'] = pwdHash($_POST['oldpassword']);
        if (isset($_POST['account'])) {
            $map['account'] = $_POST['account'];
        } elseif (isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id'] = $_SESSION[C('USER_AUTH_KEY')];
        }
        // 检查用户
        $User = M("User");
        if (! $User->where($map)
            ->field('id')
            ->find()) {
            $this->error('旧密码不符或者用户名错误！');
        } else {
            $User->password = pwdHash($_POST['password']);
            $User->save();
            $this->success('密码修改成功！');
        }
    }

    public function home ()
    {
        $this->display('Public:homepage');
    }
    
    public function register(){
        $data = $_POST;
        $type = I("type");
        if ($type == "show"){
            $this->display();
            exit();
        }
        if ($data['password'] !== $data['repassword']){
            $this->error("两次密码不一致");
        }
        unset($data['repassword']);
        
        $userModel = new UserModel();
        $result = $userModel->getByAccount($data['account']);
        if ($result) {
            $this->error('该用户名已经存在！');
        }
        $this->check($data);
     
        $data['password'] = md5($data['password']);
        $user = M("User");
        $res = $user->add($data);
        if ($res){
            $role_user = M("role_user");
            $role_user_data['role_id'] = 3;
            $role_user_data['user_id'] = $res;
            $res = $role_user->add($role_user_data);
        }

        if ($res){
            $this->success("注册成功","index");
        }else{
            $this->error("注册失败");
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
}

?>
<?php
namespace Home\Model;
use Think\Model;
use Think\Page;

class UserModel extends Model
{

    public function get_user_list ($role_id,$nickname)
    {
        $paramer = array(
                'nickname' => $nickname,
                'role_id' => $role_id
        );
        $str = " 1 = 1 ";
        if ($nickname){
            $str .= " AND nickname like '%".$nickname."%' ";
        }
        $join = "";
        if ($role_id){
            $join = ' LEFT JOIN oyyq_role_user ON oyyq_role_user.user_id = oyyq_user.id ';
            $str .= " AND oyyq_role_user.role_id = ".$role_id;
        }
        
        $where['_string'] = $str;
        $User = M('User');
        $field = ' count(id) as num ';
        $num = $User->field($field)->join($join)->where($where)->select();
        $total = $num[0]['num'];
        
        $page = new Page($total, 20, $paramer);
        $show = $page->show();

        $data = $User->join($join)->where($where)->limit($page->firstRow, $page->listRows)
            ->order(' id DESC')
            ->select();
        $data = $this->fix_user_list($data);
        
        return array(
                'show' => $show,
                'data' => $data
        );
    }
    /**
     * 
     * @param unknown $data
     */
    public function fix_user_list($data){
        if (is_array($data)){
            foreach ($data as $key => &$value){
                $value['role_name'] = '';
                if (isset($value['role_id'])){
                    $role_id = $value['role_id'];
                    $role = M('Role');
                    $where = array('id'=> $role_id);
                    $res = $role->where($where)->select();
                    if ($res){
                        $value['role_name'] = $res[0]['name'];
                    }
                }else{
                    $user_id  = $value['id'];
                    $role = M('Role');
                    $where = array('user_id'=> $user_id);
                    $join = ' LEFT JOIN oyyq_role_user ON oyyq_role_user.role_id = oyyq_role.id ';
                    $res = $role->join($join)->where($where)->select();
                    if ($res){
                        $value['role_name'] = $res[0]['name'];
                    }
                }
                
                if (isset($value['status']) && $value['status']){
                    $value['status'] = '已启用';
                }else {
                    $value['status'] = '未启用';
                }
                
                 
            }
        }
        
        return $data;
    }
    /**
     * 添加用户
     */
    public function addUser ()
    {
        $sql = "insert into ";
    }

    public function getUserListByRoleName ($role_name)
    {
        $sql = "select oyyq_user.id,oyyq_user.nickname ";
        $sql .= " ,(SELECT count(oyyq_losoyyq_call_customer.id)  FROM oyyq_losoyyq_call_customer WHERE oyyq_losoyyq_call_customer.user_id = oyyq_user.id ) as lostCallNum ";
        $sql .= " FROM oyyq_user  JOIN oyyq_role_user ON oyyq_role_user.user_id = oyyq_user.id ";
        $sql .= " JOIN oyyq_role ON oyyq_role_user.role_id = oyyq_role.id ";
        $sql .= " WHERE oyyq_role.name like '" . $role_name . "'";
        
        $result = $this->query($sql);
        
        return $result;
    }

   /**
     * 获取指定的角色下的用户列表
     * $roleIds 格式为 (1,2)
     * @param unknown $roleIds
     */
    public function getUserListByRoleId($roleIds,$status = 'all'){
        
        $SQL  = " SELECT oyyq_user.id,oyyq_user.nickname,oyyq_role_user.role_id FROM oyyq_user ";
        $SQL .= " JOIN oyyq_role_user ON oyyq_role_user.user_id = oyyq_user.id ";
        $SQL .= " WHERE   oyyq_role_user.role_id in $roleIds ";

        if ( 'all' != $status){
            $SQL .= " AND oyyq_user.status = ".$status;
        }

        $result = $this->query($SQL);
        
        return $result;
        
    }
    
    /**
     * 通过user_id 来获取当前用户的所有角色
     * @param unknown $user_id
     */
    public function getRoleIdsByUserId($user_id){
        $role_user = M('Role_user');
        $where['user_id'] = $user_id;
        $roleList = $role_user->where($where)->select();
    
        if (is_array($roleList)){
            $roleIds = array();
            foreach ($roleList as $key => $value){
                $role_id = $value['role_id'];
                $roleIds[] = $role_id;
            }
            return $roleIds;
        }else{
            return array();
        }
    
    }
}
?>
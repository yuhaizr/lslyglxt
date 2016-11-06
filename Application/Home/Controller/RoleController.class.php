<?php
namespace Home\Controller;

class RoleController extends BaseController
{

    /**
     * 角色列表
     */
    public function roleList ()
    {
        $Role = M('Role');
        $Roleinfodata = $Role->where(array('status'=>'1'))->select();
        foreach ($Roleinfodata as $key => $value) {
            $roleinfolist[$key]['id'] = $value['id'];
            $roleinfolist[$key]['name'] = $value['name'];
            $roleinfolist[$key]['status'] = $value['status'];
            $roleinfolist[$key]['remark'] = $value['remark'];
        }
        $roleinfolist = $this->fixRoleList($roleinfolist);
        $this->assign('roleinfolist', $roleinfolist);
        $this->display();
    }
    
    public function fixRoleList($list){
        if (is_array($list)){
            foreach ($list as $key => &$val){
                if (isset($val['status'])&& $val['status']){
                    $val['status'] = '启用';
                }else{
                    $val['status'] = '未启用';
                }
            }
        }
        return $list;
    }
    
    public function roleDel(){
    	$id = i('id');
    	$role = M('Role');
    	$where = array('id'=>$id);
    	$res = $role->where($where)->delete();
    	if ($res){
    		$this->crmSuccess('删除成功');
    	}else {
    		$this->crmError('删除失败') ;
    	}
    }

    /**
     * 添加角色
     */
    public function roleAdd ()
    {
        if ('menu' != I('type')) {
            $role = D('Role');
            $data = array();
            $data['id'] = null;
            $data['name'] = I('post.rolename');
            $data['pid'] = 0;
            $data['status'] = I('post.rolestatus', 0);
            $data['remark'] = I('post.remark');
            if (!$data['name']){
                $this->error('角色名必填');
            }
            
            if (mbstrlen($data['name']) > 20){
                $this->error('角色名必须小于20字');
            }
            if (mbstrlen($data['remark']) > 20){
                $this->error('备注必须小于100字');
            }           
            $r = $role->add($data);
            $this->crmSuccess('添加成功', U('/Home/Role/roleList'));
        }
        $this->display();
    }

    /**
     * 编辑角色
     */
    public function roleEdit ()
    {
        $Role = M('Role');
        if ('POST' == I('server.REQUEST_METHOD')) {
            
            if (!$_POST['name']){
                $this->error('角色名必填');
            }
            
            if (mbstrlen($_POST['name']) > 20){
                $this->error('角色名必须小于20字');
            }
            if (mbstrlen($_POST['remark']) > 20){
                $this->error('备注必须小于100字');
            }
            
            $result = $Role->save($_POST);
            $id = I('post.id');
            if ($result === false) {
                $this->crmError('保存失败', U("roleEdit?id={$id}"));
            } else {
                $this->crmSuccess('保存成功', U("roleEdit?id={$id}"));
            }
        } else {
            $id = I('get.id');
            $roleinfo = $Role->where("id = $id")->find();
            $this->assign('id', $id);
            $this->assign('roleinfo', $roleinfo);
            $this->display();
        }
    }

    /**
     * 用户授权
     */
    public function roleAuth ()
    {
        $Role = D('Role');
        $Node = M('Node');
        $RoleUser = M('RoleUser');
        if ('POST' == I('server.REQUEST_METHOD')) {} else {
            $id = I('get.id'); // 用户组id
            $action = I('get.action');
            $actionId = I('get.actionId', '0');
            $funId = I('get.funId', '0');
            $rolelist = $Role->select();
            $where['level'] = 1;

            
            // 获取所有操作
            $nodelist = $Node->where($where)->select();
            foreach ($nodelist as $value) {
                $moduleList[$value['id']]['title'] = $value['title'];
                if ($value['id'] == $actionId) {
                    $moduleList[$value['id']]['selected'] = '1';
                } else {
                    $moduleList[$value['id']]['selected'] = '0';
                }
            }
            // 获取当前项目的授权模块信息
            $groupId = $id;
            $groupModuleList = array();
            if (! empty($groupId)) {
                $this->assign("selectGroupId", $groupId);
                // 获取当前用户组的操作
                $grouplist = $Role->getGroupModuleList($groupId);
                foreach ($grouplist as $vo) {
                    $groupModuleList[$vo['id']] = $vo['id'];
                }
            }
            foreach ($moduleList as $key => &$value) {
                if (isset($groupModuleList[$key])) {
                    $value['selected'] = '1';
                } else {
                    $value['selected'] = '0';
                }
            }
            unset($value);
            foreach ($rolelist as &$value) {
                if ($value['id'] == $id) {
                    $value['roleselect'] = '1';
                } else {
                    $value['roleselect'] = '0';
                }
            }
            unset($value);
            $groupActionList = array();
            if (! empty($id) && ! empty($actionId)) {
                // 获取当前组的操作权限列表
                $list = $Role->getGroupActionList($groupId, $actionId);
                if ($list) {
                    foreach ($list as $vo) {
                        $groupActionList[] = $vo['id'];
                    }
                }
            }
            if ($actionId != '0') {
                $map['level'] = 2;
                $map['pid'] = $actionId;
                $list = $Node->where($map)
                    ->field('id,title')
                    ->order('sort')
                    ->select();
                if ($list) {
                    foreach ($list as $vo) {
                        $actionList[$vo['id']] = $vo['title'];
                    }
                }
                foreach ($actionList as $key => &$value) {
                    if (in_array($key, $groupActionList)) {
                        $value = array(
                                "title" => $value,
                                'selected' => '1'
                        );
                    } else {
                        $value = array(
                                "title" => $value,
                                'selected' => '0'
                        );
                    }
                }
                
                unset($value);
                //获取当前用户的控制器
                $myActionList = $this->getMyActionList($id,$actionId,$groupActionList);
            }
            $groupFunctionList = array();
            if (! empty($id) && ! empty($funId)) {
                // 获取当前组的操作权限列表
                $list = $Role->getGroupActionList($groupId, $funId);
                if ($list) {
                    foreach ($list as $vo) {
                        $groupFunctionList[] = $vo['id'];
                    }
                }
            }
            if ($funId != '0') {
                $map['level'] = 3;
                $map['pid'] = $funId;
                $list = $Node->where($map)
                    ->field('id,title')
                    ->order('sort')
                    ->select();
                if ($list) {
                    foreach ($list as $vo) {
                        $funList[$vo['id']] = $vo['title'];
                    }
                }
                foreach ($funList as $key => &$value) {
                    if (in_array($key, $groupFunctionList)) {
                        $value = array(
                                "title" => $value,
                                'selected' => '1'
                        );
                    } else {
                        $value = array(
                                "title" => $value,
                                'selected' => '0'
                        );
                    }
                }
                unset($value);
            }
            
            
            $this->assign('actionlist', $actionList);
            $this->assign('myActionlist', $myActionList);
            $this->assign('funid', $funId);
            $this->assign('funList', $funList);
            $this->assign('action', $action);
            $this->assign('actionid', $actionId);
            $this->assign('groupActionList', $actionList);
            $this->assign('groupModuleList', $groupModuleList);
            $this->assign('moduleList', $moduleList);
            $this->assign('roleid', $id);
            $this->assign('rolelist', $rolelist);
            $this->display();
        }
    }
    
    private function getMyActionList($id,$actionId,$groupActionList){
        $access = M("Access");
        $where['role_id'] = $id;
        $where['pid '] = $actionId;
        $where['level '] = 2;
        $list = $access->where($where)->select();
        $myActionlist = array();
        if($list){
            foreach  ($list as $key => $val){
                $node_id = $val['node_id'];
                $node = M("Node");
                $node_where['id'] = $node_id;
                $node_res = $node->where($node_where)->select();
                if($node_res){
                    $node_res = $node_res[0];
                    $myActionlist[$node_res['id']] = $node_res['title'];
                }
            }
        }
        
        foreach ($myActionlist as $key => &$value) {
            if (in_array($key, $groupActionList)) {
                $value = array(
                        "title" => $value,
                        'selected' => '1'
                );
            } else {
                $value = array(
                        "title" => $value,
                        'selected' => '0'
                );
            }
        }
        
        return $myActionlist;
    }

    /**
     * 设置模块授权
     */
    public function setRoleMedule ()
    {
        $id = $_POST['groupId'];
        $groupId = $_POST['rolegroup'];
        $group = D("Role");
        $group->delGroupModule($groupId);
        $result = $group->setGroupModules($groupId, $id);
        if ($result === false) {
            $this->crmError('添加失败', U("roleAuth?id={$groupId}"));
        } else {
            $this->crmSuccess('添加成功', U("roleAuth?id={$groupId}"));
        }
    }

    /**
     * 用户组用户列表
     */
    public function roleUserList ()
    {
        $roleid = I('get.id');
        $Role = D('Role');
        $Node = M('User');
        $RoleUser = M('RoleUser');
        $roleinfodata = $Role->select();
        $roleuser = $RoleUser->where("role_id = '$roleid'")->select();
        foreach ($roleuser as $value) {
            $user[] = $value[user_id];
        }
        $where['status'] = '1';
        $nodeList = $Node->where($where)->select();
        foreach ($nodeList as &$value) {
            if (in_array($value['id'], $user)) {
                $value['selected'] = '1';
            } else {
                $value['selected'] = '0';
            }
        }
        unset($value);
        foreach ($roleinfodata as &$value) {
            if ($value['id'] == $roleid) {
                $value['roleselect'] = '1';
            } else {
                $value['roleselect'] = '0';
            }
        }
        unset($value);
        $this->assign('nodelist', $nodeList);
        $this->assign('Roleinfodata', $roleinfodata);
        $this->display();
    }

    /**
     * 添加用户到用户组
     */
    public function useraddrole ()
    {
        $role = I('post.role');
        $userid = I('post.user');
        $Role = D("Role");
        $Role->delGroupUser($role);
       // $Role->delUserFromGroup($userid);
        $result = $Role->setGroupUsers($role, $userid);
        if ($result === false) {
            $this->crmError('授权失败', U("/Home/Role/roleUserList?id=$role"));
        } else {
            $this->crmSuccess('授权成功', U("/Home/Role/roleUserList?id=$role"));
        }
    }
    
    /**
     * 设置操作授权,level = 2 控制器授权
     */
    public function setActionList(){
        $groupId = I('post.groupId');
        $actionList = I('post.actionList');
        $moduleId = I('post.actionId');
        
        $access = M("Access");
        $this->delActionList($groupId,$moduleId);
        $access->startTrans();
        $falg = true;
        foreach ($actionList as $key =>$val){
            $res = $this->is_have_action($groupId, $val);
            if (!$res){

               $data['role_id'] = $groupId;
               $data['node_id'] = $val;
               $data['level'] = 2;
               $data['pid'] = $moduleId;
               $is_add = $access->add($data);
               if (!$is_add){
                   $access->rollback();
                   $falg = false;
               }
            }
        }
        if ($falg){
            $access->commit();
            $this->crmSuccess("授权成功");
        }else {
            $this->crmError("授权失败") ;
        }
        
        
    }
    
    private function delActionList($groupId,$moduleId){
        $access = M("Access");
        $where['role_id'] = $groupId;
        $where['pid'] = $moduleId;
        $where['level'] = 2;
        $access->where($where)->delete();
    }
    
    private function is_have_action($groupId,$actionId){
        $access = M("Access");
        $where['role_id'] = $groupId;
        $where['node_id'] = $actionId;
        
       return  $access->where($where)->select();
        
    }

    /**
     * 设置操作授权
     */
    public function setRoleAction ()
    {
        $id = I('post.funcaction');
        $funid = I('post.funId');
        $groupId = I('post.groupId');
        $moduleId = I('post.actionId');
        $action = I('post.action');
        $group = D("Role");
        $a = $group->delGroupAction($groupId, $moduleId, $funid);
        $result = $group->setGroupActions($groupId, $id, $funid);
        
        if ($result === false) {
            $this->crmError('修改失败',
                    U(
                            "/Home/Role/roleAuth?action=$action&id=$groupId&actionId=$moduleId"));
        } else {
            $this->crmSuccess('修改成功',
                    U(
                            "/Home/Role/roleAuth?action=$action&id=$groupId&actionId=$moduleId"));
        }
    }

    /**
     * 删除用户组
     */
    public function Roledelete ()
    {
        $model = M('Role');
        if (! empty($model)) {
            $id = $_REQUEST['id'];
            if (isset($id)) {
                $condition = array(
                        'id' => array(
                                'in',
                                explode(',', $id)
                        )
                );
                $list = $model->where($condition)->setField('status', 0);
                if ($list !== false) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
}

?>
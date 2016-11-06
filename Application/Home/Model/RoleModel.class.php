<?php
namespace Home\Model;

class RoleModel extends BaseModel
{
    public function addRole($param)
    {
        $sql = 'INSERT INTO t_role(
                        id, name, pid, status, remark)
                VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($param);
        
        return $this->db->lastInsertId();
    }
    /**
     * 获取当前用户组下的操作
     * @param unknown $groupId
     * @return PDOStatement
     */
    public function getGroupModuleList ($groupId)
    {
        $table = $this->tablePrefix . 'access';
        $rs = $this->db->query(
            "select b.id,b.title,b.name from " . $table . " as a ," .
            $this->tablePrefix .
            "NODE as b where a.node_id=b.id and b.pid=0 and a.role_id=$groupId");
        return $rs;
    }
    function delGroupUser ($groupId)
    {
        $table = $this->tablePrefix . 'role_user';
    
        $result = $this->db->execute(
            'delete from ' . $table . ' where role_id=' . $groupId);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }
    function delUserFromGroup ($userIdList)
    {
        $table = $this->tablePrefix . 'role_user';
        if (is_string($userIdList)) {
            $userIdList = explode(',', $userIdList);
        }
        array_walk($userIdList, array(
        $this,
        'fieldFormat'
        ));
        $userIdList = implode(',', $userIdList);
        $result = $this->db->execute(
            'delete from ' . $table . ' where user_id in (' . $userIdList .
            ')');
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }
    function setGroupUsers ($groupId, $userIdList)
    {
        if (empty($userIdList)) {
            return true;
        }
        if (is_string($userIdList)) {
            $userIdList = explode(',', $userIdList);
        }
        array_walk($userIdList, array(
        $this,
        'fieldFormat'
        ));
        $userIdList = implode(',', $userIdList);
        $where = 'a.id =' . $groupId . ' AND b.id in(' . $userIdList . ')';
        $rs = $this->execute(
            'INSERT INTO ' . $this->tablePrefix .
            'ROLE_USER (role_id,user_id) SELECT a.id, b.id FROM ' .
            $this->tablePrefix . 'role a, ' . $this->tablePrefix .
            'user b WHERE ' . $where);
        if ($rs === false) {
            return false;
        } else {
            return true;
        }
    }
    protected function fieldFormat (&$value)
    {
//         if (is_int($value)) {
//             $value = intval($value);
//         } else
//             if (is_float($value)) {
//                 $value = floatval($value);
//             } else
//                 if (is_string($value)) {
//                     $value = '"' . addslashes($value) . '"';
//                 }
//             return $value;
            $value = intval($value);
            return $value;
    }
    
    function delGroupModule ($groupId)
    {
        $table = $this->tablePrefix . 'access';
        $sql = 'delete from ' . $table . ' where level=1 and role_id=' .$groupId;
        $result = $this->db->execute(
            'delete from ' . $table . ' where level=1 and role_id=' .
            $groupId);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }
    
    function setGroupModules ($groupId, $moduleIdList)
    {
        if (empty($moduleIdList)) {
            return true;
        }
        if (is_array($moduleIdList)) {
            $moduleIdList = implode(',', $moduleIdList);
        }
        $where = 'a.id =' . $groupId . ' AND b.id in(' . $moduleIdList . ')';
        $rs = $this->db->execute(
            'INSERT INTO ' . $this->tablePrefix .
            'access (role_id,node_id,level) SELECT a.id, b.id,b.level FROM ' .
            $this->tablePrefix . 'ROLE a, ' . $this->tablePrefix .
            'NODE b WHERE ' . $where);
        if ($rs === false) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * 获取当前组的操作权限列表
     * @param unknown $groupId
     * @param unknown $moduleId
     * @return unknown
     */
    function getGroupActionList ($groupId, $actioneId)
    {
        $table = $this->tablePrefix . 'access';
        $sql = 'select b.id,b.title,b.name from ' . $table . ' as a ,' .
            $this->tablePrefix .
            'node as b where a.node_id=b.id and  b.pid=' . $actioneId .
            ' and  a.role_id=' . $groupId . ' ';
        $rs = $this->db->query($sql);
        return $rs;
    }
    
    
    function delGroupAction ($groupId, $moduleId,$funId)
    {
        $table = $this->tablePrefix . 'access';
        $sql = 'delete from ' . $table . ' where level=2 and pid=' . $moduleId .
                         ' and role_id=' . $groupId.' and node_id='.$funId;
        $result = $this->db->execute($sql);
        
        $sql = 'delete from ' . $table . ' where level=3 and pid=' . $funId .
                         ' and role_id=' . $groupId;
        
        $result = $this->db->execute($sql);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }
    
    function setGroupActions ($groupId, $actionIdList,$funid)
    {
        if (empty($actionIdList)) {
            return true;
        }
        if (is_array($actionIdList)) {
            $actionIdList = implode(',', $actionIdList);
            $actionIdList .= ",$funid";
        }
        $where = 'a.id =' . $groupId . ' AND b.id in(' . $actionIdList . ')';
        $sql = 'INSERT INTO ' . $this->tablePrefix .
                         'ACCESS (role_id,node_id,pid,level) SELECT a.id, b.id,b.pid,b.level FROM ' .
                         $this->tablePrefix . 'ROLE a, ' . $this->tablePrefix .
                         'NODE b WHERE ' . $where;
        $rs = $this->db->execute($sql);
        if ($rs === false) {
            return false;
        } else {
            return true;
        }
    }
}

?>
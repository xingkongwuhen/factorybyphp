<?php
  namespace app\admin\controller;
  use think\Controller;
  use app\admin\controller\Base;
  use Util\data\Sysdb;

  /**
   *用户管理界面
   *根据用户相对应的管理等级 确定用户的管理权限 根据用户的管理权限 判断该用户可以使用的相关菜单 和
   */
  class Admin extends Base
  {

      public function index()
      {
        $user = $this->user;
        $menus = false;
        $roes = $this->db->table('user_group')->where(array('id'=>$user['gid'],'is_del'=>0))->info();

        if($roes)
        {
          $roes['status'] = (isset($roes['status']) && $roes['status']) ? json_decode($roes['status']) : [];
        }
        if($roes['id'] == 1)
        {
          $where = 'ishidden = 0 and status = 0';
          $menus = $this->db->table("menu")->where($where)->order("sort_id")->cates('id');
          $menus =  $this->gettreemenus($menus);
        }elseif($roes['status']){
          $where = 'id in('.implode(',',$roes['status']).') and ishidden = 0 and status = 0';
          $menus = $this->db->table("menu")->where($where)->order("sort_id")->cates('id');
          $menus =  $this->gettreemenus($menus);
        }
       $web_config = $this->db->table("webconfig")->where(array("web_cs"=>'webname'))->info();

        $web_config && $web_config['web_value'] = $web_config['web_value'];
        $this->assign('web_name',$web_config);
        $this->assign('roes',$roes);
        $this->assign('menus',$menus);
        $this->assign('user',$user);
        return $this->fetch();
      }

      //对菜单进行处理使其具有格式化
      private function gettreemenus($data)
      {
        $tree = array();
        foreach ($data as $item ) {
          if(isset($data[$item['pid']]))
          {
            $data[$item['pid']]['children'][] = &$data[$item['id']];
          }else{
            $tree[] = &$data[$item['id']];
          }
        }
           return $tree;
      }
      //建立欢迎页面，级Home
      public function welcome()
      {
        return $this->fetch();
      }


  }



 ?>

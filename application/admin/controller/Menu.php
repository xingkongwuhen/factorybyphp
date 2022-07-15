<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Menu extends Base
  {

      public function index()
      {
        $pid = (int)input('get.pid');
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

        // $menulist = $this->db->table('menu')->where(array("pid"=>$pid))->order("sort_id")->lists();
        $maxorderid = $this->db->table('menu')->where(array("pid"=>$pid))->max("sort_id");
        $orderid = $maxorderid + 1;
        $backid = 0;
        if($pid > 0)
        {
          $parent = $this->db->table('menu')->where(array('id'=>$pid))->info();
          $backid = $parent['pid'];
        }
          $this->assign('orderid',$orderid);
          $this -> assign('pid',$pid);
          $this -> assign('backid',$backid);
          $this -> assign('list',$menus);
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
      //保存或更新
      public function save()
      {
          $pid = (int)input('post.pid');
          $menunames = input('post.menunames/a');
          $sort_ids = input('post.orders/a');
          $controllers = input('post.controllers/a');
          $methods = input('post.methods/a');
          $ishiddens = input('post.ishiddens/a');
          $status = input('post.status/a');

          foreach($sort_ids as $key => $value)
          {
            $res = true;
            $data = [
              'pid' => $pid,
              'sort_id' => $value,
              'menuname' => $menunames[$key],
              'controller' => $controllers[$key],
              'method'  => $methods[$key],
              'ishidden' => isset($ishiddens[$key])? 1:0,
              'status' => isset($status[$key])? 1:0
            ];
            if($key == 0 && $data['menuname']){
             $this->db->table('menu')->insert($data);
            }
            if($key > 0 && $data['menuname'] == '' && $data['controller'] == '' && $data['method'] == '')
            {
               $this->db->table('menu')->where(array("id"=>$key))->del();
               $this->db->table('menu')->where(array('pid'=>$key))->del();
            }else{
               $this->db->table('menu')->where(array("id"=>$key))->update($data);
            }
            if(!$res){
              $statu = 0;
              $msg = "更新失败";
            }else{
              $statu = 1;
              $msg = "更新成功";
            }

          }
          return ['status'=>$statu,'msg'=>$msg];

      }



  }



 ?>

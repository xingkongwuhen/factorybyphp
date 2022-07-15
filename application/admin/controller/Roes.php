<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Roes extends Base
  {
    public function index()
    {
      $list = $this->db->table('user_group')->where(array('is_del'=>0,'is_edit'=>0))->lists();
      $this->assign('list',$list);
      return $this->fetch();
    }
    //管理员添加初始化
    public function add()
    {
      $menulist = $this->db->table('menu')->where(array('status'=>0))->cates('id');

      $menus = $this->gettreemenus($menulist);
      $result = array();
      foreach ($menus as $value) {
        $value['children'] = isset($value['children'])?$this->formatMenus($value['children']):false;
  			$results[] = $value;
      }
      $this->assign('menus',$results);
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

    //将多级菜单格式化，使其变为一级菜单
    private function formatMenus($items,&$res = array()){
      foreach($items as $item){
        if(!isset($item['children'])){
          $res[] = $item;
        }else{
          $tem = $item['children'];
          unset($item['children']);
          $res[] = $item;
          $this->formatMenus($tem,$res);
        }
      }
      return $res;
    }
    //保存数据
    public function saveadd()
    {
      $statu = 1;
      $msg = "美人恭喜过关！";
      $menus = input('post.menu/a');
      $data = [
        'typename' => trim(input('post.typename')),
      ];
      if(!$data['typename']){
        $status = 0;
        $msg = "没名字的角色，纵使是美人也不能过！";
      }
      $data['status'] = json_encode(array_keys($menus));
      $res =  $this->db->table('user_group')->insert($data);
      if(!$res)
      {
        $status = 0;
        $msg = "插错地方了！";
      }

        return ['status'=>$statu,'msg'=>$msg];
    }
    //编辑初始化
    public function edit()
    {
      $id = (int)input('get.id');
      $info = $this->db->table('user_group')->where(array('id'=>$id))->info();

      if($info && $info['status'])
      {
        $info['status'] = json_decode($info['status']);
      }else{
        $info['status'] = '';
      }

      $menulist = $this->db->table('menu')->where(array('status'=>0))->cates('id');
      $menus = $this->gettreemenus($menulist);
      $result = array();
      foreach ($menus as $value) {
        $value['children'] = isset($value['children'])?$this->formatMenus($value['children']):false;
        $results[] = $value;
      }
      $this->assign('info',$info);
      $this->assign('menus',$results);
      return $this->fetch();
    }
    //保存数据
    public function saveedit()
    {
      $statu = 1;
      $msg = "美人恭喜过关！";
      $menus = input('post.menu/a');
      $data = [
        'typename' => trim(input('post.typename')),
        'id'      => (int)input('post.id')
      ];
      if(!$data['typename']){
        $status = 0;
        $msg = "没名字的角色，纵使是美人也不能过！";
      }
      $data['status'] = json_encode(array_keys($menus));
      $res =  $this->db->table('user_group')->where(array('id'=>$data['id']))->update($data);
      if(!$res)
      {
        $status = 0;
        $msg = "插错地方了！";
      }

        return ['status'=>$statu,'msg'=>$msg];
    }
    //进入软删除
    public function del()
    {
      $id = (int)input('get.id');
      $time = time();
      $res = $this->db->table('user_group')->where(array('id'=>$id))->update(['is_del'=>1,'deltime'=>$time]);
      if(!$res)
      {
        $status = 0;
        $msg = "删除失败";
      }else{
        $status = 1;
        $msg = "删除成功";
      }
      return ['status'=>$status,'msg'=>$msg];
    }

  }
?>

<?php
  namespace app\admin\controller;
  use think\Controller;
  use Util\data\Sysdb;
  use think\Session;
  use app\admin\controller\Base;

  /**
   *
   */
  class User extends Controller
  {
      //管理员登陆页面
      public function login()
      {
        return $this->fetch();
      }
      //管理员登陆检查
      public function checklogin()
      {
          $username = trim(input('post.username'));
          $password = trim(input('post.password'));
          $verifycode = trim(input('post.verifycode'));
          $status = 1;
          $msg = "登陆成功";
          if($username == '')
          {
              $status = 0;
              $msg = "用户名不能为空";
          }
          if($password == '')
          {
              $status = 0;
              $msg = "密码不能为空";
          }
          if($verifycode == '')
          {
              $status = 0;
              $msg = "验证码不能为空";
          }
          if(!captcha_check($verifycode))
          {
              $status = 0;
              $msg = "验证码不正确";
          }
          $this->db = new Sysdb;
          $user = $this->db->table('user')->where(array('name'=>$username,'is_del'=>0))->info();
          if(!$user)
          {
              $status = 0;
              $msg = "用户不存在";
          }
          if($user && md5($password) != $user['password'])
          {
            $status = 0;
            $msg = "用户密码错误";
          }
          if($user['status'] == 1)
          {
            $status = 0;
            $msg = "用户被禁用";
            exit();
          }
          // Session::set('user')
          session('user',$user);
          // exit(json_encode(array('status'=>$status,'msg'=>$msg)));
          return ['status'=>$status,'msg'=>$msg];

      }

      public function index()
      {
        $this->db = new Sysdb;
        $list = $this->db->table('user')->where(array('is_del'=>0))->lists();
        $glist = $this->db->table('user_group')->cates('id');
        $this -> assign('list',$list);
        $this -> assign('glist',$glist);
        return $this->fetch();
      }
      // 停用或启用管理员
      public function changestatus()
      {
        $id = (int)input('get.id');
        $res = true;
        $this->db = new Sysdb;
        $statu = $this->db->table('user')->field('status')->where(array('id'=>$id))->info();
        if($statu['status'] == '0')
        {
          $res = $this->db->table('user')->where(array('id'=>$id))->update(['status'=>1]);
          if(!$res)
          {
            $status = 0;
            $msg = "停用失败";
          }else{
            $status = 1;
            $msg = "停用成功";
          }

        }else{
            $res = $this->db->table('user')->where(array('id'=>$id))->update(['status'=>0]);
            if(!$res)
            {
              $status = 0;
              $msg = "启用失败";
            }else{
              $status = 1;
              $msg = "启用成功";
            }
        }
        return ['status'=>$status,'msg'=>$msg];
      }

      //管理员添加
      public function add()
      {
        $this->db = new Sysdb;
        $list = $this->db->table('user_group')->where(array('is_del'=>0,'is_edit'=>0))->lists();
        $this -> assign('list',$list);
        return $this->fetch();
      }
      //管理员添加保存
      public function saveadd()
      {
          $password = trim(input('post.password'));
        $data = [
          'name' => trim(input('post.name')),
          'truename' => trim(input('post.truename')),
          'gid' => (int)input('post.gid'),
          'status' => trim(input('post.status')),
          'createtime' => time()
        ];
        if(!$data['name'])
        {
            $status = 0;
            $msg = "用户名不能为空";
        }
        if(!$password)
        {
            $status = 0;
            $msg = "密码不能为空";
        }else{
            $data['password'] = md5($password);
        }
        if(!$data['gid'])
        {
            $status = 0;
            $msg = "请选择管理员角色";
        }
        $this->db = new Sysdb;
        $user = $this->db->table('user')->where(array('name'=>$data['name']))->info();
        if(!$user)
        {
            //保存数据
            $res = $this->db->table('user')->insert($data);
            if(!$res)
            {
              $status = 0;
              $msg = "保存失败";
            }else{
              $status = 1;
              $msg = "保存成功";
            }
        }else{
          $status = 0;
          $msg = "用户名已存在";
        }
        return ['status'=>$status,'msg'=>$msg];
      }

      //管理员编辑初始化
      public function edit()
      {
        $id = (int)(input('get.id'));

        $this -> db = new Sysdb;
        $info = $this->db->table('user')->where(array('id'=>$id,'is_del'=>0))->info();
        if($info['gid'] == 1){
          $glist = $this->db->table('user_group')->where(array('is_del'=>0))->cates('id');
        }else{
          $glist = $this->db->table('user_group')->where(array('is_edit'=>0,'is_del'=>0))->cates('id');
        }

        $this->assign('info',$info);
        $this->assign('glist',$glist);
        return $this->fetch();
      }

      //管理员编辑保存
      public function saveedit()
      {
        $id = (int)input('post.id');
        $res = true;
        $password = trim(input('post.password'));
        $data = [
          'truename' => trim(input('post.truename')),
          'gid' => (int)input('post.gid'),
          'status' => trim(input('post.status')),
        ];

        if($password)
        {
            $data['password'] = md5($password);
        }
          $this->db = new Sysdb;
            //保存数据
         $this->db->table('user')->where(array('id'=>$id))->update($data);
            if(!$res)
            {
              $status = 0;
              $msg = "保存失败";
            }else{
              $status = 1;
              $msg = "保存成功";
            }

        return ['status'=>$status,'msg'=>$msg];
      }
      //管理员删除
      public function del()
      {
        $id = (int)input('get.id');
        $time = time();
        $this->db = new Sysdb;
        $res = $this->db->table('user')->where(array('id'=>$id))->update(['is_del'=>1,'deltime'=>$time]);
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
      //撤回管理员删除操作
      public function undel(){
        $this->db = new Sysdb;
        $list = $this->db->table('user')->where(array('is_del'=>1))->lists();
        $this->assign('list',$list);
        return $this->fetch();
      }
      //恢复
      public function undelet()
      {
        $id = (int)input('get.id');
        $this->db = new Sysdb;
        if($id > 0){
          $res = $this->db->table('user')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('user')->where(array('is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }
        if(!$res)
        {
          $status = 0;
          $msg = "恢复失败";
        }else{
          $status = 1;
          $msg = "恢复成功";
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      //彻底删除
      public function delet()
      {
        $id = (int)input('get.id');
        $this->db = new Sysdb;
        if($id > 0){
          $res = $this->db->table('user')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('user')->where(array('is_del'=>1))->del();
        }
        if(!$res)
        {
          $status = 0;
          $msg = "彻底删除失败";
        }else{
          $status = 1;
          $msg = "彻底删除成功";
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      public function logout()
      {
          session('user',null);
          $status = 1;
          $msg = "退出成功";
          return ['stauts'=>$status,'msg'=>$msg];
      }

  }



 ?>

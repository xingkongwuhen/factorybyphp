<?php
  namespace app\admin\controller;
  use think\Controller;
  use Util\data\Sysdb;

  /**
   *
   */
  class Base extends Controller
  {

      public function __construct()
      {
        parent::__construct();

        $this->user = session('user');
        //未登录用户不可登陆
        if(!$this->user)
        {
          // return "13213123";
          header('Location:/public/admin/User/login');
          exit;
        }
        // return $this->fetch();
        $this->db = new Sysdb;
      }


  }



 ?>

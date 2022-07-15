<?php
  namespace app\index\controller;
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

        $this->db = new Sysdb;
      }


  }



 ?>

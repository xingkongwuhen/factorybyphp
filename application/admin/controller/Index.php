<?php
  namespace app\admin\controller;
  use think\Controller;
  use app\admin\controller\Base;
  use Util\data\Sysdb;

  /**
   *
   */
  class Index extends Base
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
        $info = array(
        'OS'=>PHP_OS,
        'PATH'=>$_SERVER["SERVER_SOFTWARE"],
        'PHP_TYPE'=>php_sapi_name(),
        'TP'=>THINK_VERSION,
        'MAX_UPLOAD'=>ini_get('upload_max_filesize'),
        'TIME'=>ini_get('max_execution_time').'秒',
        'RUN_TIME'=>date("Y年n月j日 H:i:s"),
        'BJ_TIME'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
        'IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
        'SPACE'=>round((disk_free_space(".")/(1024*1024)),2).'M',
        'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
        'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
        'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );
        $this->assign('info',$info);
        return $this->fetch();
      }


  }



 ?>

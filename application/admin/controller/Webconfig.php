<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   * 系统设置页面
   * zhonghuaxinxing@sina.cn
   * 此处可以自由添加相关变量，系统自动判断 前面加上 web;
   * 相关字段 web_name web_value web_type
   */
  class Webconfig extends Base
  {
    /*初始化 表单页面*/
    public function index()
    {
      $weblist = $this->db->table('webconfig')->lists();
      $this->assign('weblist',$weblist);
      return $this->fetch();
    }

    /**
     * 变量添加保存
     */
    public function add()
    {
      return $this -> fetch();
    }

    /**
     * 变量添加保存
     */
    public function blsave()
    {
      $status = 1;
      $msg = 0;
      $webname = trim(input('post.webname'));
      $webcs = trim(input('post.webcs'));
      $webtype = trim(input('post.webtype'));
      $webcs = 'web'.$webcs;
      $data = [
        'web_name' => $webname,
        'web_cs' => $webcs,
        'web_type' => $webtype
      ];
      $webconfig = $this->db->table("webconfig")->where(array('web_name'=>$webname,'web_cs'=>$webcs))->info();
      if(!$webconfig)
      {
        $this->db->table("webconfig")->insert($data);
      }else{
        $status = 0;
        $msg = "变量已存在";
      }

      return ['status'=>$status,'msg'=>$msg];
    }
    //保存前台输入的数据
    public function save()
    {
      $status = 1;
      $msg = "全局变量更新成功";
      $webvalue = input('post.webvalue/a');
      $webcs = input('post.webcs/a');
      $i = 0;
      $html = '<?php '."\r\n";
      foreach($webvalue as $key => $value)
      {
        $res = true;
        /*循环将相关网站系统配置写入 webconfig的文件中 以方便进行二次读取*/
        $html .= '$'.$webcs[$key] .' = '.'"'.$webvalue[$key].'";'."\r\n";
        $data = [
          'web_value' => $webvalue[$key]
        ];
       $this->db->table('webconfig')->where(array("id"=>$key))->update($data);
      }
      $html .=" ?>";
      /*打开要写入的文件 如果没有则进行创建*/
      $myfile = fopen("webconfig.php", "w") or die("Unable to open file!");
      /*像文件中写入数据*/
      fwrite($myfile, $html);
      /*关闭写入完成的文件*/
      fclose($myfile);
      return ['status'=>$status,'msg'=>$msg];
    }

  }
?>

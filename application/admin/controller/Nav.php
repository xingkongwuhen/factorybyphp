<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Nav extends Base
  {

      public function index()
      {
        $pid = (int)input('get.pid');
        $menulist = $this->db->table('nav')->where(array("pid"=>$pid))->order('sort_id asc')->lists();


        $backid = 0;
        if($pid > 0)
        {
          $parent = $this->db->table('nav')->where(array('id'=>$pid))->info();
          $backid = $parent['pid'];
        }

          $this -> assign('pid',$pid);
          $this -> assign('backid',$backid);
          $this -> assign('list',$menulist);
          return $this->fetch();

      }

      //保存或更新
      public function save()
      {
          $pid = (int)input('post.pid');
          $titles = input('post.titles/a');
          $sort_ids = input('post.orders/a');
          $urls = input('post.urls/a');
          $entitles = input('post.entitles/a');
          $imgurls = input('post.imgurls/a');
          $status = input('post.status/a');

          foreach($sort_ids as $key => $value)
          {
            $res = true;
            $data = [
              'pid' => $pid,
              'sort_id' => $value,
              'title' => $titles[$key],
              'entitle' => $entitles[$key],
              'url' => $urls[$key],
              'imgurl'  => $imgurls[$key],
              'status' => isset($status[$key])? 1:0
            ];
            // var_dump($data); die();
            if($key == 0 && $data['title']){
             $this->db->table('nav')->insert($data);
            }
            if($key > 0 && $data['title'] == '' && $data['url'] == '')
            {
               $this->db->table('nav')->where(array("id"=>$key))->del();
            }else{
               $this->db->table('nav')->where(array("id"=>$key))->update($data);
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

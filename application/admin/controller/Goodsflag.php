<?php
  /**
   * shop商城 商品属性管理管理
   * @星空  2018.12.6  对接数据表为 shop_goods_flag
   * 初步分为热卖等自定义属性
   */
   namespace app\admin\controller;  //初始化命名空间
   use app\admin\controller\Base; //加载初始化Base 文件

   /***
   *加载商品的首页  及商品列表相关页面
   ***/
   class Goodsflag extends Base
   {
      public function index()
      {
        $flaglist = $this->db->table('goods_flag')->order('sort_id asc')->lists();
        $maxorder = $this->db->table('goods_flag')->max('sort_id');
          $this->assign('orderid',$maxorder+1);
          $this -> assign('list',$flaglist);
          return $this -> fetch();
      }

      /*保存/更新相关属性*/
      //保存或更新
      public function save()
      {
          $pid = (int)input('post.pid');
          $titles = input('post.titles/a');
          $sort_ids = input('post.orders/a');
          $signs = input('post.signs/a');
          $entitles = input('post.entitles/a');
          $imgurls = input('post.imgurls/a');
          $status = input('post.status/a');

          foreach($sort_ids as $key => $value)
          {
            $res = true;
            $data = [
              'sort_id' => $value,
              'title' => $titles[$key],
              'entitle' => $entitles[$key],
              'sign' => $signs[$key],
              'imgurl'  => $imgurls[$key],
              'status' => isset($status[$key])? 1:0
            ];
            // var_dump($data); die();
            if($key == 0 && $data['title']){
             $this->db->table('goods_flag')->insert($data);
            }
            if($key > 0 && $data['title'] == '' && $data['sign'] == '')
            {
               $this->db->table('goods_flag')->where(array("id"=>$key))->del();
            }else{
               $this->db->table('goods_flag')->where(array("id"=>$key))->update($data);
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

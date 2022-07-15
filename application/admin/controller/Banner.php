<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *Banner管理 通过菜单列表页面进入获取值
   *作者： 张洪刚
   *数据库结构 // 包含所有字段
   *ID: ID;标题: title;图片: imgurl; 链接：url; 排序：orderid; 分类：type;状态：status;
   *是否删除：is_del; 删除时间：deltime; 创建时间：createtime;
   */
  class Banner extends Base
  {
    /**
     * Banner 列表页
     *$pagesize 每页显示的数目；
     */
      public function index()
      {
        $pagesize = 10;
        $page = max(1,(int)input('get.page'));
        $where = 'is_del=0';
        $list = $this->db->table('banner')->where($where)->order('id asc')->pages($pagesize);
        foreach($list['lists'] as $key => $value )
        {  //循环输出各个影片的类型
          $type =$this->db->table('bannertype')->field('title')->where(array('id'=>$value['type']))->info();
          $list['lists'][$key]['type'] = $type['title'];
        }
        $this->assign('page',$page);
        $this->assign('pagesize',$pagesize);
        $this->assign("list",$list);
        return $this->fetch();
      }
      /**
       * Banner添加加载
       */
      public function add()
      {
        $typelist = $this->db->table('bannertype')->where(array('status'=>0))->lists();
        if($typelist)
        {
          $this->assign('typelist',$typelist);
        }else{
          echo '<script>
            alert("请先添加分类！");
            window.location.href="/public/admin/Banner/type";
          </script>';

          exit();
        }
        return $this->fetch();
      }
      /**
       * Banner编辑加载
       */
      public function edit()
      {
        $id = (int)input('get.id');
        $info = $this->db->table('banner')->where(array('id'=>$id))->info();
        $typelist = $this->db->table('bannertype')->where(array('status'=>0))->lists();
        if($typelist)
        {
          $this->assign('typelist',$typelist);
        }else{
          echo '<script>
            alert("请先添加分类！");
            window.location.href="/public/admin/Banner/type";
          </script>';

          exit();
        }
        $this->assign('info',$info);

        return $this->fetch();
      }
      /**
       * Banner添加保存
       */
      public function saveadd()
      {
        $data = [
          'title' => trim(input('post.title')),
          'imgurl' => trim(input('post.imgurl')),
          'url' => trim(input('post.url')),
          'type' => (int)input('post.type'),
          'orderid' => (int)input('post.orderid'),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入幻灯片名";
        }
        if(!$data['imgurl'])
        {
            $status = 0;
            $msg = "请上传幻灯片缩略图";
        }

        $video = $this->db->table('banner')->where(array('title'=>$data['title']))->info();
        if(!$video)
        {
            //保存数据
            $res = $this->db->table('banner')->insert($data);
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
          $msg = "标题已被占用，请重新填写";
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      /**
       * Banner编辑保存
       */
      public function saveedit()
      {
        $id = (int)input('post.id');
        $data = [
          'title' => trim(input('post.title')),
          'imgurl' => trim(input('post.imgurl')),
          'url' => trim(input('post.url')),
          'type' => (int)input('post.type'),
          'orderid' => (int)input('post.orderid'),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入影片名";
        }
        if(!$data['imgurl'])
        {
            $status = 0;
            $msg = "请上传幻灯片缩略图";
        }
            //更新
            $res = $this->db->table('banner')->where(array('id'=>$id))->update($data);
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
      /**
       *Banner分类管理 通过菜单列表页面进入获取值
       *作者： 张洪刚
       *数据库结构 // 包含所有字段
       *ID: ID;标题: title; 状态：status;
       */
      public function type()
      {
        $list = $this->db->table('bannertype')->lists();
        $this->assign("list",$list);
        return $this->fetch();
      }
      /**
       * Banner分类保存
       */
      public function typesave()
      {
        $titles = input('post.titles/a');
        $status = input('post.status/a');
        foreach($titles as $key => $value)
        {
          $res = true;
          $data = [
            'title' => $titles[$key],
            'status' => isset($status[$key])? 1:0
          ];
          if($key == 0 && $data['title']){
           $this->db->table('bannertype')->insert($data);
          }
          if($key > 0 && $data['title'] == '')
          {
             $this->db->table('bannertype')->where(array("id"=>$key))->del();
          }else{
             $this->db->table('bannertype')->where(array("id"=>$key))->update($data);
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

      /**
       * Banner禁用
       */
      public function changestatus()
      {
        $id = (int)input('get.id');
        // $res = true;
        $status = $this->db->table('banner')->where(array('id'=>$id))->info();
        if($status['status'] == 0)
        {
          $res = $this->db->table('banner')->where(array('id'=>$id))->update(['status'=>1]);
          if($res){
            $status = 1;
            $msg = "停用成功";
          }else{
            $status = 0;
            $msg = "停用失败";
          }
        }else{
          $res = $this->db->table('banner')->where(array('id'=>$id))->update(['status'=>0]);
          if($res){
            $status = 1;
            $msg = "启用成功";
          }else{
            $status = 0;
            $msg = "启用失败";

          }
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      /**
       * Banner软删除
       */
      public function del()
      {
        $id = (int)input('get.id');
        $time = time();
        $res = $this->db->table('banner')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
        if($res){
          $status = 1;
          $msg = "删除成功";
        }else{
          $status = 0;
          $msg = "删除失败";
        }
          return ['status'=>$status,'msg'=>$msg];
      }

      /**
       * Banner回收站
       */
      public function undel()
      {
        $vlist = $this->db->table('banner')->where(array('is_del'=>1))->lists();
        $this->assign("list",$vlist);
        return $this->fetch();
      }
      /**
       * Banner恢复
       */
      public function undelet()
      {
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('banner')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('banner')->where(array('is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
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
      /**
       * Banner彻底删除
       */
      public function delet()
      {
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('banner')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('banner')->where(array('is_del'=>1))->del();
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

  }
?>

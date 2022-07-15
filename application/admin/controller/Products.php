<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Products extends Base
  {
      public function index()
      {
        $pagesize = 10;
        $page = max(1,(int)input('get.page'));
        $keys = trim(input('get.key'));
        if($keys != ''){
          $where = '(title like "%'.$keys.'%" or keywords like "%'.$keys.'%") and is_del=0';
        }else{
          $where = 'is_del=0';
        }

        $vlist = $this->db->table('product')->where($where)->order('orderid asc')->pages($pagesize);
        // $piclist = $this->db->table('piclist')->where($where)->order('orderid asc')->lists();

        foreach($vlist['lists'] as $key => $value )
        {  //循环输出各个影片的类型
          $type =$this->db->table('protype')->field('title')->where(array('id'=>$value['type']))->info();
          $list['lists'][$key]['type'] = $type['title'];
        }
        // $this->assign('page',$page);
        $this->assign('page',$page);
        $this->assign('pagesize',$pagesize);
        $this->assign('key',$keys);
        $this->assign("list",$vlist);

        return $this->fetch();
      }
      public function add()
      {
        $typelist = $this->db->table('newstype')->where(array('status'=>0,'is_del'=>0))->lists();
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
      public function edit()
      {
        $id = (int)input('get.id');
        $typelist = $this->db->table('newstype')->where(array('status'=>0,'is_del'=>0))->lists();
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
        $info = $this->db->table('news')->where(array('id'=>$id))->info();
        $this->assign('info',$info);
        return $this->fetch();
      }
      //文章添加保存
      public function saveadd()
      {
        $data = [
          'title' => trim(input('post.title')),
          'entitle' => trim(input('post.entitle')),
          'content' => trim(input('post.content')),
          'keywords' => trim(input('post.keywords')),
          'is_phone' => trim(input('post.phone')),
          'type' => (int)input('post.type'),
          'orderid'  => trim(input('post.orderid')),
          'imgurl' => trim(input('post.imgurl')),
          'description' => trim(input('post.description')),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入文章名";
        }

        $video = $this->db->table('news')->where(array('title'=>$data['title']))->info();
        if(!$video)
        {
            //保存数据
            $res = $this->db->table('news')->insert($data);
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
          $msg = "文章已存在，请重新填写";
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      //文章更新保存
      public function saveedit()
      {
        $id = (int)input('post.id');
        $data = [
          'title' => trim(input('post.title')),
          'entitle' => trim(input('post.entitle')),
          'content' => trim(input('post.content')),
          'keywords' => trim(input('post.keywords')),
          'is_phone' => trim(input('post.phone')),
          'type' => (int)input('post.type'),
          'orderid'  => trim(input('post.orderid')),
          'imgurl' => trim(input('post.imgurl')),
          'description' => trim(input('post.description')),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入文章名";
        }


            //保存数据
            $res = $this->db->table('news')->where(array('id'=>$id))->update($data);
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
      //视频发布或下架
      public function changestatus()
      {
        $id = (int)input('get.id');
        // $res = true;
        $status = $this->db->table('news')->where(array('id'=>$id))->info();
        if($status['status'] == 0)
        {
          $res = $this->db->table('news')->where(array('id'=>$id))->update(['status'=>1]);
          if($res){
            $status = 1;
            $msg = "停用成功";
          }else{
            $status = 0;
            $msg = "停用失败";
          }
        }else{
          $res = $this->db->table('news')->where(array('id'=>$id))->update(['status'=>0]);
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
      //软删除操作
      public function del()
      {
        $id = (int)input('get.id');
        $time = time();
        $res = $this->db->table('news')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
        if($res){
          $status = 1;
          $msg = "删除成功";
        }else{
          $status = 0;
          $msg = "删除失败";
        }
          return ['status'=>$status,'msg'=>$msg];
      }

      //删除撤回操作
      public function undel()
      {
        $vlist = $this->db->table('news')->where(array('is_del'=>1))->lists();
        $this->assign("list",$vlist);
        return $this->fetch();
      }
      //恢复
      public function undelet()
      {
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('news')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('news')->where(array('is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
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
        if($id > 0){
          $res = $this->db->table('news')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('news')->where(array('is_del'=>1))->del();
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




      //文章分类

      // 列表
      public function type()
      {
        $pagesize = 10;
        $page = max(1,(int)input('get.page'));
        $where = 'is_del=0';
        $tlist = $this->db->table('newstype')->where($where)->order('id asc')->pages($pagesize);
        foreach ($tlist['lists'] as $key => $value) {
          if($value['pid'] > 0)
          {
            $type =$this->db->table('newstype')->field('title')->where(array('id'=>$value['pid']))->info();
             $tlist['lists'][$key]['ptitle'] = $type['title'];
          }else{
            $tlist['lists'][$key]['ptitle'] = '一级分类';
          }
        }
        $this->assign('page',$page);
        $this->assign('pagesize',$pagesize);
        $this->assign("list",$tlist);

        return $this->fetch();
      }
      //添加文章分类
      public function typeadd()
      {
        $typelist = $this->db->table('newstype')->where(array('is_del'=>0,'status'=>0))->lists();
        $typelist && $this->assign('tlist',$typelist);
        return $this->fetch();
      }
      public function typeedit()
      {
        $id = (int)input('get.id');
        $info = $this->db->table('newstype')->where(array('id'=>$id))->info();
        $typelist = $this->db->table('newstype')->where(array('is_del'=>0,'status'=>0))->lists();
        $typelist && $this->assign('tlist',$typelist);
        $this->assign('info',$info);
        return $this->fetch();
      }
      //分类添加保存
      public function savetypeadd()
      {
        $data = [
          'title' => trim(input('post.title')),
          'entitle' => trim(input('post.entitle')),
          'imgurl' => trim(input('post.imgurl')),
          'pid' => (int)input('post.pid'),
          'description' => trim(input('post.description')),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入分类名";
        }

        $video = $this->db->table('newstype')->where(array('title'=>$data['title']))->info();
        if(!$video)
        {
            //保存数据
            $res = $this->db->table('newstype')->insert($data);
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
          $msg = "分类已存在，请重新填写";
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      //分类更新保存
      public function savetypeedit()
      {
        $id = (int)input('post.id');
        $data = [
          'title' => trim(input('post.title')),
          'entitle' => trim(input('post.entitle')),
          'imgurl' => trim(input('post.imgurl')),
          'pid' => (int)input('post.pid'),
          'description' => trim(input('post.description')),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入分类名";
        }

            //保存数据
            $res = $this->db->table('newstype')->where(array('id'=>$id))->update($data);
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
      //视频发布或下架
      public function typechangestatus()
      {
        $id = (int)input('get.id');
        // $res = true;
        $status = $this->db->table('newstype')->where(array('id'=>$id))->info();
        if($status['status'] == 0)
        {
          $res = $this->db->table('newstype')->where(array('id'=>$id))->update(['status'=>1]);
          if($res){
            $status = 1;
            $msg = "停用成功";
          }else{
            $status = 0;
            $msg = "停用失败";
          }
        }else{
          $res = $this->db->table('newstype')->where(array('id'=>$id))->update(['status'=>0]);
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
      //影片软删除操作
      public function typedel()
      {
        $id = (int)input('get.id');
        $time = time();
        $res = $this->db->table('newstype')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
        if($res){
          $status = 1;
          $msg = "删除成功";
        }else{
          $status = 0;
          $msg = "删除失败";
        }
          return ['status'=>$status,'msg'=>$msg];
      }

      //影片删除撤回操作
      public function typeundel()
      {
        $vlist = $this->db->table('newstype')->where(array('is_del'=>1))->lists();
        $this->assign("list",$vlist);
        return $this->fetch();
      }
      //恢复
      public function typeundelet()
      {
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('newstype')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('newstype')->where(array('is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
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
      public function typedelet()
      {
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('newstype')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('newstype')->where(array('is_del'=>1))->del();
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

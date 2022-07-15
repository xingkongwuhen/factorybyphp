<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Product extends Base
  {
      public function index()
      {
        $mid = (int)input('get.mid');
        $pagesize = 10;
        $page = max(1,(int)input('get.page'));
        $keys = trim(input('get.key'));
        if($keys != ''){
          $where = '(title like "%'.$keys.'%" or keywords like "%'.$keys.'%") and is_del=0 and mid='.$mid;
        }else{
          $where = 'is_del=0 and mid='.$mid;
        }

        $vlist = $this->db->table('product')->where($where)->order('orderid asc')->pages($pagesize);

        foreach($vlist['lists'] as $key => $value )
        {  //循环输出各个影片的类型
          $type =$this->db->table('protype')->field('title')->where(array('id'=>$value['type']))->info();
          $vlist['lists'][$key]['type'] = $type['title'];
        }
        $this->assign('mid',$mid);
        $this->assign('page',$page);
        $this->assign('pagesize',$pagesize);
        $this->assign('key',$keys);
        $this->assign("list",$vlist);

        return $this->fetch();
      }
      public function add()
      {
        $mid = (int)input('get.mid');
        $typelist = $this->db->table('protype')->where(array('status'=>0,'is_del'=>0,'mid'=>$mid))->lists();
        if($typelist)
        {
          $this->assign('mid',$mid);
          $this->assign('typelist',$typelist);
        }else{
          echo '<script>
            alert("请先添加分类！");
            window.location.href="/public/admin/Product/type";
          </script>';

          exit();
        }
        return $this->fetch();
      }
      public function edit()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        $typelist = $this->db->table('protype')->where(array('status'=>0,'is_del'=>0,'mid'=>$mid))->lists();
        if($typelist)
        {
          $this->assign('typelist',$typelist);
        }else{
          echo '<script>
            alert("请先添加分类！");
            window.location.href="/public/admin/Product/type";
          </script>';

          exit();
        }
        $info = $this->db->table('product')->where(array('id'=>$id))->info();
        if($info['imgarr'])
        {
          $info['piclist'] = explode(",",$info['imgarr']);
        }else{
          $info['piclist'] = '';
        }
        $this->assign('mid',$mid);
        $this->assign('info',$info);
        return $this->fetch();
      }
      //文章添加保存
      public function saveadd()
      {
        $picarr = input('post.pc_src/a');
        $imgarr = implode(',',$picarr);
        $data = [
          'title' => trim(input('post.title')),
          'entitle' => trim(input('post.entitle')),
          'mid' => (int)input('post.mid'),
          'content' => trim(input('post.content')),
          'keywords' => trim(input('post.keywords')),
          'is_phone' => trim(input('post.phone')),
          'type' => (int)input('post.type'),
          'actor' => trim(input('post.actor')),
          'tj' => trim(input('post.tj')),
          'orderid'  => trim(input('post.orderid')),
          'imgurl' => trim(input('post.imgurl')),
          'imgarr' => $imgarr,
          'description' => trim(input('post.description')),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        if(!$data['title'])
        {
            $status = 0;
            $msg = "请输入文章名";
        }

        $product = $this->db->table('product')->where(array('title'=>$data['title']))->info();
        if(!$product)
        {
            //保存数据
            $res = $this->db->table('product')->insert($data);
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
          $msg = "图文已存在，请重新填写";
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      //文章更新保存
      public function saveedit()
      {
        $picarr = input('post.pc_src/a');
        $imgarr = implode(',',$picarr);
        // var_dump($pics); die();
        $id = (int)input('post.id');
        $data = [
          'title' => trim(input('post.title')),
          'entitle' => trim(input('post.entitle')),
          'content' => trim(input('post.content')),
          'keywords' => trim(input('post.keywords')),
          'is_phone' => trim(input('post.phone')),
          'type' => (int)input('post.type'),
          'imgarr' => $imgarr,
          'actor' => trim(input('post.actor')),
          'tj' => trim(input('post.tj')),
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
            $res = $this->db->table('product')->where(array('id'=>$id))->update($data);
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
        $status = $this->db->table('product')->where(array('id'=>$id))->info();
        if($status['status'] == 0)
        {
          $res = $this->db->table('product')->where(array('id'=>$id))->update(['status'=>1]);
          if($res){
            $status = 1;
            $msg = "停用成功";
          }else{
            $status = 0;
            $msg = "停用失败";
          }
        }else{
          $res = $this->db->table('product')->where(array('id'=>$id))->update(['status'=>0]);
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
      //视频发布或下架
      public function changetj()
      {
        $id = (int)input('get.id');
        // $res = true;
        $status = $this->db->table('product')->where(array('id'=>$id))->info();
        if($status['tj'] == 0)
        {
          $res = $this->db->table('product')->where(array('id'=>$id))->update(['tj'=>1]);
          if($res){
            $status = 1;
            $msg = "推荐成功";
          }else{
            $status = 0;
            $msg = "推荐失败";
          }
        }else{
          $res = $this->db->table('product')->where(array('id'=>$id))->update(['tj'=>0]);
          if($res){
            $status = 1;
            $msg = "取消推荐成功";
          }else{
            $status = 0;
            $msg = "取消推荐失败";

          }
        }
        return ['status'=>$status,'msg'=>$msg];
      }
      //软删除操作
      public function del()
      {
        $id = (int)input('get.id');
        $time = time();
        $res = $this->db->table('product')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
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
        $mid = (int)input('get.mid');
        $vlist = $this->db->table('product')->where(array('is_del'=>1,'mid'=>$mid))->lists();
        $this->assign("list",$vlist);
        $this->assign('mid',$mid);
        return $this->fetch();
      }
      //恢复
      public function undelet()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('product')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('product')->where(array('is_del'=>1,'mid'=>$mid))->update(['is_del'=>0,'deltime'=>null]);
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
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('product')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('product')->where(array('is_del'=>1,'mid'=>$mid))->del();
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
        $mid = (int)input('get.mid');
        // return $mid;
        $pagesize = 10;
        $page = max(1,(int)input('get.page'));
        $where = 'is_del=0 and mid='.$mid;
        $tlist = $this->db->table('protype')->where($where)->order('id asc')->pages($pagesize);
        foreach ($tlist['lists'] as $key => $value) {
          if($value['pid'] > 0)
          {
            $type =$this->db->table('protype')->field('title')->where(array('id'=>$value['pid']))->info();
             $tlist['lists'][$key]['ptitle'] = $type['title'];
          }else{
            $tlist['lists'][$key]['ptitle'] = '一级分类';
          }
        }
        $this->assign('mid',$mid);
        $this->assign('page',$page);
        $this->assign('pagesize',$pagesize);
        $this->assign("list",$tlist);

        return $this->fetch();
      }
      //添加文章分类
      public function typeadd()
      {
        $mid = (int)input('get.mid');
        $typelist = $this->db->table('protype')->where(array('is_del'=>0,'status'=>0,'mid'=>$mid))->lists();
        // $typelist &&
        if($typelist)
        {
          $typelist = $typelist;
        }else{
          $typelist = [];
        }
        // var_dump($typelist); die();
        $this->assign('tlist',$typelist);
        $this->assign('mid',$mid);
        return $this->fetch();
      }
      public function typeedit()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        $info = $this->db->table('protype')->where(array('id'=>$id))->info();
        $typelist = $this->db->table('protype')->where(array('is_del'=>0,'status'=>0))->lists();
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
          'mid' => (int)input('post.mid'),
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

        $video = $this->db->table('protype')->where(array('title'=>$data['title']))->info();
        if(!$video)
        {
            //保存数据
            $res = $this->db->table('protype')->insert($data);
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
          'mid' => (int)input('post.mid'),
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
            $res = $this->db->table('protype')->where(array('id'=>$id))->update($data);
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
        $status = $this->db->table('protype')->where(array('id'=>$id))->info();
        if($status['status'] == 0)
        {
          $res = $this->db->table('protype')->where(array('id'=>$id))->update(['status'=>1]);
          if($res){
            $status = 1;
            $msg = "停用成功";
          }else{
            $status = 0;
            $msg = "停用失败";
          }
        }else{
          $res = $this->db->table('protype')->where(array('id'=>$id))->update(['status'=>0]);
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
        $res = $this->db->table('protype')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
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
        $mid = (int)input('get.mid');
        $vlist = $this->db->table('protype')->where(array('is_del'=>1,'mid'=>$mid))->lists();
        $this->assign("list",$vlist);
        $this->assign('mid',$mid);
        return $this->fetch();
      }
      //恢复
      public function typeundelet()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('protype')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('protype')->where(array('is_del'=>1,'mid'=>$mid))->update(['is_del'=>0,'deltime'=>null]);
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
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('protype')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('protype')->where(array('is_del'=>1,'mid'=>$mid))->del();
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

<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Videos extends Base
  {

    public function index()
    {
      $mid = (int)input('get.mid');
      // $mid = 1;
      $pagesize = 10;
      $page = max(1,(int)input('get.page'));
      $keys = trim(input('get.key'));
      if($keys != ''){
        $where = '(title like "%'.$keys.'%" or keywords like "%'.$keys.'%") and is_del=0 and mid='.$mid;
      }else{
        $where = 'is_del=0 and mid='.$mid;
      }

      $vlist = $this->db->table('videos')->where($where)->order('id asc')->pages($pagesize);

      foreach($vlist['lists'] as $key => $value )
      {  //循环输出各个影片的类型
        $pindao = $this->db->table('videotype')->field('title')->where(array('id'=>$value['pindao']))->info();
        $charge = $this->db->table('videotype')->field('title')->where(array('id'=>$value['charge']))->info();
        $area =$this->db->table('videotype')->field('title')->where(array('id'=>$value['area']))->info();
        $vlist['lists'][$key]['pindao'] = $pindao['title'];
        $vlist['lists'][$key]['charge'] = $charge['title'];
        $vlist['lists'][$key]['area'] = $area['title'];
      }
      $this->assign('mid',$mid);
      $this->assign('page',$page);
      $this->assign('pagesize',$pagesize);
      $this->assign('key',$keys);
      $this->assign("list",$vlist);

      return $this->fetch();
    }

    //影片添加加载
    public function add()
    {
      $mid = (int)input('get.mid');
      $pdlist = $this->db->table('videotype')->where(array("flag"=>'pindao','status'=>0,'mid'=>$mid))->lists();
      $chargelist = $this->db->table('videotype')->where(array("flag"=>'charge','status'=>0,'mid'=>$mid))->lists();
      $arealist = $this->db->table('videotype')->where(array("flag"=>'area','status'=>0,'mid'=>$mid))->lists();
      $this -> assign('pdlist',$pdlist);
      $this -> assign('mid',$mid);
      $this -> assign('chargelist',$chargelist);
      $this -> assign('arealist',$arealist);
      return $this->fetch();
    }
    //影片编辑加载
    public function edit()
    {
      $id = (int)input('get.id');
      $mid = (int)input('get.mid');
      $info = $this->db->table('videos')->where(array('id'=>$id,'mid'=>$mid))->info();
      $pdlist = $this->db->table('videotype')->where(array("flag"=>'pindao','status'=>0,'mid'=>$mid))->lists();
      $chargelist = $this->db->table('videotype')->where(array("flag"=>'charge','status'=>0,'mid'=>$mid))->lists();
      $arealist = $this->db->table('videotype')->where(array("flag"=>'area','status'=>0,'mid'=>$mid))->lists();
      $this -> assign('pdlist',$pdlist);
      $this -> assign('mid',$mid);
      $this -> assign('chargelist',$chargelist);
      $this -> assign('arealist',$arealist);
      $this -> assign('info',$info);
      return $this->fetch();
    }

    //影片添加保存
    public function saveadd()
    {
      $data = [
        'title' => trim(input('post.name')),
        'imgurl' => trim(input('post.imgurl')),
        'videourl' => trim(input('post.videourl')),
        'keywords' => trim(input('post.keywords')),
        'description' => trim(input('post.description')),
        'pindao' => (int)input('post.pid'),
        'charge' => (int)input('post.cid'),
        'area' => (int)input('post.aid'),
        'status' => (int)input('post.status'),
        'mid' => (int)input('post.mid'),
        'createtime' => time()
      ];
      if(!$data['title'])
      {
          $status = 0;
          $msg = "请输入影片名";
      }
      if(!$data['videourl'])
      {
          $status = 0;
          $msg = "请输入影片地址/上传影片";
      }
      if(!$data['imgurl'])
      {
          $status = 0;
          $msg = "请上传影片缩略图";
      }

      $video = $this->db->table('videos')->where(array('title'=>$data['title']))->info();
      if(!$video)
      {
          //保存数据
          $res = $this->db->table('videos')->insert($data);
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
        $msg = "影片名已被占用，请重新填写";
      }
      return ['status'=>$status,'msg'=>$msg];
    }
    //影片便就/修改保存
    public function saveedit()
    {
      $id = (int)input('post.id');
      $data = [
        'title' => trim(input('post.name')),
        'imgurl' => trim(input('post.imgurl')),
        'videourl' => trim(input('post.videourl')),
        'keywords' => trim(input('post.keywords')),
        'description' => trim(input('post.description')),
        'pindao' => (int)input('post.pid'),
        'charge' => (int)input('post.cid'),
        'area' => (int)input('post.aid'),
        'status' => (int)input('post.status'),
        'createtime' => time()
      ];
      if(!$data['title'])
      {
          $status = 0;
          $msg = "请输入影片名";
      }
      if(!$data['videourl'])
      {
          $status = 0;
          $msg = "请输入影片地址/上传影片";
      }
      if(!$data['imgurl'])
      {
          $status = 0;
          $msg = "请上传影片缩略图";
      }
          //保存数据
          $res = $this->db->table('videos')->where(array('id'=>$id))->update($data);
          if(!$res)
          {
            $status = 0;
            $msg = "修改失败";
          }else{
            $status = 1;
            $msg = "修改成功";
          }
      return ['status'=>$status,'msg'=>$msg];
    }
    //视频发布或下架
    public function changestatus()
    {
      $id = (int)input('get.id');
      // $res = true;
      $status = $this->db->table('videos')->where(array('id'=>$id))->info();
      if($status['status'] == 0)
      {
        $res = $this->db->table('videos')->where(array('id'=>$id))->update(['status'=>1]);
        if($res){
          $status = 1;
          $msg = "下架成功";
        }else{
          $status = 0;
          $msg = "下架失败";
        }
      }else{
        $res = $this->db->table('videos')->where(array('id'=>$id))->update(['status'=>0]);
        if($res){
          $status = 1;
          $msg = "发布成功";
        }else{
          $status = 0;
          $msg = "发布失败";

        }
      }
      return ['status'=>$status,'msg'=>$msg];
    }
    //影片软删除操作
    public function del()
    {
      $id = (int)input('get.id');
      $time = time();
      $res = $this->db->table('videos')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
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
    public function undel()
    {
      $mid = (int)input('get.mid');
      $vlist = $this->db->table('videos')->where(array('is_del'=>1,'mid'=>$mid))->lists();
      $this->assign("list",$vlist);
      $this->assign('mid',$mid);
      return $this->fetch();
    }
    //恢复
    public function undelet()
    {
      $id = (int)input('get.id');
      $mid = (int)input('get.mid');
      if($id > 0){
        $res = $this->db->table('videos')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
      }else{
        $res = $this->db->table('videos')->where(array('is_del'=>1,'mid'=>$mid))->update(['is_del'=>0,'deltime'=>null]);
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
      $mid = (int)input('get.mid');
      if($id > 0){
        $res = $this->db->table('videos')->where(array('id'=>$id,'is_del'=>1))->del();
      }else{
        $res = $this->db->table('videos')->where(array('is_del'=>1,'mid'=>$mid))->del();
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

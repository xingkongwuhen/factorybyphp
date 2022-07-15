<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Flag extends Base
  {
    //频道管理
    public function pindao()
    {
      $mid = (int)input('get.mid');
      $list = $this->db->table('videotype')->where(array("flag"=>'pindao','mid'=>$mid))->lists();
      $this->assign('list',$list);
      $this->assign('mid',$mid);
      return $this->fetch();
    }
    //资费管理
    public function charge()
    {
      $mid = (int)input('get.mid');
      $list = $this->db->table('videotype')->where(array("flag"=>'charge','mid'=>$mid))->lists();
      $this->assign('list',$list);
      $this->assign('mid',$mid);
      return $this->fetch();
    }
    //地区管理
    public function area()
    {
      $mid = (int)input('get.mid');
      $list = $this->db->table('videotype')->where(array("flag"=>'area','mid'=>$mid))->lists();
      $this->assign('list',$list);
      $this->assign('mid',$mid);
      return $this->fetch();
    }
    //保存或更新
    public function save()
    {
        $flag = trim(input('post.flag'));
        $menunames = input('post.menunames/a');
        $sort_ids = input('post.orders/a');
        $status = input('post.status/a');
        $mids = input('post.mids/a');

        foreach($sort_ids as $key => $value)
        {
          $res = true;
          $data = [
            'flag' => $flag,
            'sort_id' => $value,
            'title' => $menunames[$key],
            'mid' => $mids[$key],
            'status' => isset($status[$key])? 1:0
          ];
          if($key == 0 && $data['title']){
           $this->db->table('videotype')->insert($data);
          }
          if($key > 0 && $data['title'] == '')
          {
             $this->db->table('videotype')->where(array("id"=>$key))->del();
          }else{
             $this->db->table('videotype')->where(array("id"=>$key))->update($data);
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

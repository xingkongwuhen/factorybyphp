<?php
namespace app\index\controller;
use think\Controller;

class Index extends Base
{
    public function index()
    {
      $pagesize = 8;
      $bannerlist = $this->db->table('banner')->where(array('type'=>1,'is_del'=>0,'status'=>0))->lists();
      $navlist = $this->db->table('nav')->where(array('status'=>0,'pid'=>0))->order('sort_id asc')->lists();
      if($navlist)
      {
        foreach ($navlist as $key => $value) {
          $children = $this->db->table('nav')->where(array('status'=>0,'pid'=>$value['id']))->order('sort_id asc')->lists();
          if($children)
          {
            $navlist[$key]['children'] = $children;
          }else{
            $navlist[$key]['children'] = 0;
          }
        }
      }
      $videolist = $this->db->table('videos')->where(array('status'=>0,'is_del'=>0))->order('id asc')->lists();
      $this->assign('vlist',$videolist);
      $this->assign('banner',$bannerlist);
      $this->assign('nav',$navlist);
      return $this->fetch();
    }
}

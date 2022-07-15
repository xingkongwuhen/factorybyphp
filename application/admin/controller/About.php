<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;
  /**
   *单页管理 通过菜单列表页面进入获取值
   *作者： 张洪刚
   * mid  菜单
   * cid  分类或菜单列表ID
   *数据库结构 // 包含所有字段
   *ID: ID;标题: title;英文标题: entitle;发布人: actor;图片: imgurl;关键词: keywords;描述: description;电话: tel;
   *邮箱: email;经度: lon;纬度: lat;网址: wurl;内容: content;排序: orderid;是否推荐: tj;是否手机显示: is_phone;
   *状态: status; 默认是 0 显示不禁用;添加更新时间: createtime是否删除: is_del;删除时间: deltime; 菜单ID: mid; 列表ID: cid;
   */
  class About extends Base
  {
    /**
     * 独立单页列表加载
     * $mid:菜单ID $cid
     */
     public function index()
     {
       $mid = (int)input('get.mid');
       $cid = (int)input('get.cid');
       $pagesize = 10;
       $page = max(1,(int)input('get.page'));
       $keys = trim(input('get.key'));
       if($keys != ''){
         $where = '(title like "%'.$keys.'%" or keywords like "%'.$keys.'%") and is_del=0 and mid='.$mid.' and cid='.$cid;
       }else{
         $where = 'is_del=0 and mid='.$mid.' and cid='.$cid;
       }
       $dlist = $this->db->table('danye')->where($where)->order('orderid asc')->pages($pagesize);

      $this->assign('list',$dlist);
      $this->assign('mid',$mid);
      $this->assign('cid',$cid);
      $this->assign('key',$keys);
      $this->assign('page',$page);
      $this->assign('pagesize',$pagesize);
       return $this->fetch();
    }
    /**
     * 独立单页的添加加载预览
     */
     public function add()
     {
       $mid = (int)input('get.mid');
       $cid = (int)input('get.cid');
       $this->assign('mid',$mid);
       $this->assign('cid',$cid);
       return $this->fetch();
     }
     /**
      * 独立单页的编辑加载预览
      */
     public function edit()
     {
       $mid = (int)input('get.mid');
       $id = (int)input('get.id');
       $cid = (int)input('get.cid');
       $info = $this->db->table('danye')->where(array('id'=>$id))->info();
       $this->assign('cid',$cid);
       $this->assign('mid',$mid);
       $this->assign('info',$info);
       return $this->fetch();
     }
     /**
      * 单页添加保存
      */
     public function saveadd()
     {
       $data = [
         'title' => trim(input('post.title')),
         'entitle' => trim(input('post.entitle')),
         'mid' => (int)input('post.mid'),
         'cid' => (int)input('post.cid'),
         'telphone' => trim(input('post.telphone')),
         'email' => trim(input('post.email')),
         'lat' => trim(input('post.lat')),
         'lon' => trim(input('post.lon')),
         'wurl' => trim(input('post.wrul')),
         'content' => trim(input('post.content')),
         'keywords' => trim(input('post.keywords')),
         'is_phone' => trim(input('post.phone')),
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
           $msg = "请输入标题";
       }
           //保存数据
        $res = $this->db->table('danye')->insert($data);
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
      * 单页更新保存
      */
     public function saveedit()
     {
       $id = (int)input('post.id');
       $data = [
         'title' => trim(input('post.title')),
         'entitle' => trim(input('post.entitle')),
         'content' => trim(input('post.content')),
         'keywords' => trim(input('post.keywords')),
         'is_phone' => trim(input('post.phone')),
         'telphone' => trim(input('post.telphone')),
         'email' => trim(input('post.email')),
         'lat' => trim(input('post.lat')),
         'lon' => trim(input('post.lon')),
         'wurl' => trim(input('post.wurl')),
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
           $msg = "请输入标题";
       }


           //保存数据
           $res = $this->db->table('danye')->where(array('id'=>$id))->update($data);
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
      * 单页是否禁用
      */
     public function changestatus()
     {
       $id = (int)input('get.id');
       // $res = true;
       $status = $this->db->table('danye')->where(array('id'=>$id))->info();
       if($status['status'] == 0)
       {
         $res = $this->db->table('danye')->where(array('id'=>$id))->update(['status'=>1]);
         if($res){
           $status = 1;
           $msg = "停用成功";
         }else{
           $status = 0;
           $msg = "停用失败";
         }
       }else{
         $res = $this->db->table('danye')->where(array('id'=>$id))->update(['status'=>0]);
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
      * 单页是否推荐
      */
     public function changetj()
     {
       $id = (int)input('get.id');
       // $res = true;
       $status = $this->db->table('danye')->where(array('id'=>$id))->info();
       if($status['tj'] == 0)
       {
         $res = $this->db->table('danye')->where(array('id'=>$id))->update(['tj'=>1]);
         if($res){
           $status = 1;
           $msg = "推荐成功";
         }else{
           $status = 0;
           $msg = "推荐失败";
         }
       }else{
         $res = $this->db->table('danye')->where(array('id'=>$id))->update(['tj'=>0]);
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
     /**
      * 单页软删除操作
      */
     public function del()
     {
       $id = (int)input('get.id');
       $time = time();
       $res = $this->db->table('danye')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
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
      * 单页删除撤回
      */
     public function undel()
     {
       $mid = (int)input('get.mid');
       $vlist = $this->db->table('danye')->where(array('is_del'=>1,'mid'=>$mid))->lists();
       $this->assign("list",$vlist);
       $this->assign('mid',$mid);
       return $this->fetch();
     }
     /**
      * 删除恢复
      */
     public function undelet()
     {
       $mid = (int)input('get.mid');
       $id = (int)input('get.id');
       if($id > 0){
         $res = $this->db->table('danye')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
       }else{
         $res = $this->db->table('danye')->where(array('is_del'=>1,'mid'=>$mid))->update(['is_del'=>0,'deltime'=>null]);
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
      * 彻底删除
      */
     public function delet()
     {
       $mid = (int)input('get.mid');
       $id = (int)input('get.id');
       if($id > 0){
         $res = $this->db->table('danye')->where(array('id'=>$id,'is_del'=>1))->del();
       }else{
         $res = $this->db->table('danye')->where(array('is_del'=>1,'mid'=>$mid))->del();
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

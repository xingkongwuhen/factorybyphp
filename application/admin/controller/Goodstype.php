<?php
  /**
   * shop商城 商品分类管理
   * @星空  2018.12.6  对接数据表为 shop_goods_type
   * 数据表相关字段
   *  id 分类ID  pid 父级ID  mid 菜单ID  pic 分类图片 is_del 是否删除 status 状态 delettime 删除时间  typename 分类名称
   *  entypename 英文名称 orderid 排序ID creattime 创建时间
   * CREATE TABLE MyGuests (
   *  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   *   firstname VARCHAR(30) NOT NULL,
   *   lastname VARCHAR(30) NOT NULL,
   *   email VARCHAR(50),
   *   reg_date TIMESTAMP
   *  )
   *
   */
   namespace app\admin\controller;  //初始化命名空间
   use app\admin\controller\Base; //加载初始化Base 文件
   /***
   *加载商品的首页  及商品列表相关页面
   ***/
   class Goodstype extends Base
   {
     /*加载首页 列表*/
      public function index()
      {
          $mid = (int)input('get.mid');
          $pagesize = 10;
          $page = max(1,(int)input('get.page'));
          $where = 'is_del=0 and mid='.$mid;
          $tlist = $this->db->table('goods_type')->where($where)->order('id asc')->pages($pagesize);
          foreach ($tlist['lists'] as $key => $value) {
            if($value['pid'] > 0)
            {
              $type =$this->db->table('goods_type')->field('typename')->where(array('id'=>$value['pid']))->info();
               $tlist['lists'][$key]['ptitle'] = $type['typename'];
            }else{
              $tlist['lists'][$key]['ptitle'] = '一级分类';
            }
          }
          $this->assign('mid',$mid);
          $this->assign('page',$page);
          $this->assign('pagesize',$pagesize);
          $this->assign("list",$tlist);
          return $this -> fetch();
      }

      /*添加页面*/
      public function add()
      {
        /*通过查询商品分类进行相关分类的选择 最终得以实现无限极分类*/
        $mid = (int)input('get.mid');
        /*查询因存在分类 以便作为上级分类输出*/
        $typelist = $this->db->table('goods_type')->where(array('is_del'=>0,'status'=>0,'mid'=>$mid))->lists();
        if($typelist)
        {
          $typelist = $typelist;
        }else{
          $typelist = [];
        }
        /*查询当前最大排序 进行排序ID 的输出*/
        $orderid = $this->db->table('goods_type')->where(array('is_del'=>0,'status'=>0,'mid'=>$mid))->max('orderid');


        $this->assign('orderid',$orderid+1);
        $this->assign('tlist',$typelist);
        $mid = (int)input('get.mid');
        $this -> assign('mid',$mid);
        return $this -> fetch();
      }
      /*修改页面*/
      public function edit()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        $info = $this->db->table('goods_type')->where(array('id'=>$id))->info();
        /*查询因存在分类 以便作为上级分类输出*/
        $typelist = $this->db->table('goods_type')->where(array('is_del'=>0,'status'=>0,'mid'=>$mid))->lists();
        if($typelist)
        {
          $typelist = $typelist;
        }else{
          $typelist = [];
        }

        $this->assign('info',$info);
        $this->assign('tlist',$typelist);
        $this -> assign('mid',$mid);
        return $this -> fetch();
      }
      /*保存添加页面*/
      public function saveadd()
      {
        $data = [
          'typename'     => trim(input('post.typename')),
          'entypename'   => trim(input('post.entypename')),
          'mid' => (int)input('post.mid'),
          'imgurl' => trim(input('post.imgurl')),
          'pid' => (int)input('post.pid'),
          'orderid'=>(int)input('post.orderid'),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];
        /*对提交的数据进行判断*/
        if(!$data['typename'])
        {
            $status = 0;
            $msg = "请输入分类名";
        }
        /*通过自写函数 将分类数据进行保存*/
        $res = $this ->db-> table('goods_type') -> insert($data);
        if($res)
        {
          $status = 1;
          $msg = '创建成功';
        }else{
          $status = 0;
          $msg = '创建失败，请重试';
        }


        return ['status'=>$status, 'msg'=>$msg];
      }
      /*保存修改*/
      public function saveedit()
      {
        $id = (int)input('post.id');
        $data = [
          'typename'     => trim(input('post.typename')),
          'entypename'   => trim(input('post.entypename')),
          'mid' => (int)input('post.mid'),
          'imgurl' => trim(input('post.imgurl')),
          'orderid'=>(int)input('post.orderid'),
          'pid' => (int)input('post.pid'),
          'status' => (int)input('post.status'),
          'createtime' => time()
        ];

        if(!$data['typename'])
        {
            $status = 0;
            $msg = "请输入分类名";
        }
        /*通过自写函数 将分类数据进行保存*/
        $res = $this ->db-> table('goods_type') ->where(array('id'=>$id)) -> update($data);
        if($res)
        {
          $status = 1;
          $msg = '修改成功';
        }else{
          $status = 0;
          $msg = '修改失败，请重试';
        }
        return ['status'=>$status, 'msg'=>$msg];
      }
      /*软删除数据*/
      public function undel()
      {
        $mid = (int)input('get.mid');
        $vlist = $this->db->table('Goods_type')->where(array('is_del'=>1,'mid'=>$mid))->lists();
        $this->assign("list",$vlist);
        $this->assign('mid',$mid);
        return $this->fetch();
      }
      /*软删除操作*/
      public function del()
      {
        $id = (int)input('get.id');
        $time = time();
        $res = $this->db->table('Goods_type')->where(array("id"=>$id))->update(['is_del'=>1,'deltime'=>$time]);
        if($res){
          $status = 1;
          $msg = "删除成功";
        }else{
          $status = 0;
          $msg = "删除失败";
        }
          return ['status'=>$status,'msg'=>$msg];
      }
      /*全部恢复*/
      public function undelet()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('Goods_type')->where(array('id'=>$id,'is_del'=>1))->update(['is_del'=>0,'deltime'=>null]);
        }else{
          $res = $this->db->table('Goods_type')->where(array('is_del'=>1,'mid'=>$mid))->update(['is_del'=>0,'deltime'=>null]);
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
      /*全部删除*/
      public function delet()
      {
        $mid = (int)input('get.mid');
        $id = (int)input('get.id');
        if($id > 0){
          $res = $this->db->table('Goods_type')->where(array('id'=>$id,'is_del'=>1))->del();
        }else{
          $res = $this->db->table('Goods_type')->where(array('is_del'=>1,'mid'=>$mid))->del();
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

      //显示/隐藏
      public function changestatus()
      {
        $id = (int)input('get.id');
        // $res = true;
        $status = $this->db->table('Goods_type')->where(array('id'=>$id))->info();
        if($status['status'] == 0)
        {
          $res = $this->db->table('Goods_type')->where(array('id'=>$id))->update(['status'=>1]);
          if($res){
            $status = 1;
            $msg = "停用成功";
          }else{
            $status = 0;
            $msg = "停用失败";
          }
        }else{
          $res = $this->db->table('Goods_type')->where(array('id'=>$id))->update(['status'=>0]);
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

   }


 ?>

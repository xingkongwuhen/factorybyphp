<?php
  /**
   * shop商城 商品列表页面
   * @星空  2018.12.6  对接数据表为 shop_goods
   */
   namespace app\admin\controller;  //初始化命名空间
   use app\admin\controller\Base; //加载初始化Base 文件

   /***
   *加载商品的首页  及商品列表相关页面
   ***/
   class GoodsJf extends Base
   {
      public function index()
      {
          $mid = (int)input('get.mid');
          $this -> assign('mid',$mid);
          return $this -> fetch();
      }

      public function add()
      {
        /*
         *商品添加分多个页面以选项卡的形式展现  最后利用ajax进行相关内容的提交
         * 因不同品牌的不同规格导致价格等因素各不相同  因此 在此 进行品牌和不同商品规格的勾选
         * 利用勾选机制 实现不同品牌 不同规格/相同规格 价格差异的解决方案
         */
        // $maxid = $this->db->table('goods')->max('id');
        // $maxorderid = $this->db->table('goods')->max('orderid');
        $mid = (int)input('get.mid'); /*菜单ID*/
        /*循环输出商品的分类 如果没有商品分类 则提示并跳转*/
        $typelist = $this->db->table('goods_type')->where(array('status'=>0,'is_del'=>0,'mid'=>$mid))->lists();
        if($typelist)
        {
          $this->assign('typelist',$typelist);
        }else{
          echo '<script>
            alert("请先添加分类！");
            window.location.href="/public/admin/Goods/type";
          </script>';
          exit();
        }
        /*循环输出商品品牌 */
        $brandlist = $this->db->table('goods_brand')->where(array('is_del'=>0,'status'=>0,'mid'=>$mid))->lists();
        $brandlist ? $brandlist : '';
        /*循环输出商品的相关属性 热卖等*/
        $flaglist = $this->db->table('goods_flag')->order('sort_id asc')->lists();
        $flaglist ? $flaglist : '';
        $this -> assign('flaglist',$flaglist);
        $this -> assign('brandlist',$brandlist);
        // $this -> assign('orderid',$orderid);
        // $this -> assign('goods_id', $id);
        $this -> assign('orderid',0);
        $this -> assign('goods_id', 2);
        $this -> assign('mid',$mid);
        return $this -> fetch();

      }

      /**
       * 存储规格  相关规格列表
       */
      public function save_attr()
      {
        /**
         * 将前台的规格值和规格列表存入相关规格的数据表
         */
         if(request()->isPost()){
            $data=request()->post();
            $goods_id = $data['goods_id'];
            $key=json_decode($data['key'],true);
            $value=json_decode($data['value'],true);
            // $goods_id=1;
            $key_id=[];
            $this->db->table('goods_attr')->where(array('goods_id'=>$goods_id))->del();
            foreach ($key as $k) {
              $result = $this->db->table('goods_attr')->where(array('attr_name'=>$k,'goods_id'=>$goods_id))->info();
              if(!$result){
                $data = [
                  'attr_name' => $k,
                  'goods_id' => $goods_id
                ];
                 $result['attr_id'] = $this->db->table('goods_attr')->insertGetId($data);
              }
              $key_id[]=$result['attr_id'];
            }
            $tm_v_in=[];
            $tm_v=[];
            $this->db->table('goods_attr_val')->where(array('goods_id'=>$goods_id))->del();
            foreach ($value as $key=>$v){
                $attr_key_id=$key_id[$key];
                foreach ($v as $v1){
                  $res = $this->db->table('goods_attr_val')->where(array('attr_value'=>$v1,'attr_id'=>$attr_key_id))->info();
                    if(!$res){
                      $data = [
                        'attr_id' => $attr_key_id,
                        'attr_value' => $v1,
                        'goods_id' => $goods_id
                      ];
                      $res['attr_val_id'] = $this->db->table('goods_attr_val')->insertGetId($data);
                    }
                    $tm_v[]=$res['attr_val_id'];
                }
            }
            return ['stauts'=>0,'key'=>$key_id,'value'=>$tm_v];
        }

      }

      /**
       * 保存相关属性值对应的价格区间 包含所有商品
       */
      public function save_attr_value()
      {
        if(request()->isPost()){
            $data=request()->post();
            $attr = $data['obj'];
            $goods = $data['goods'];
            $content = $data['content'];
            $shop = $data['shop'];

            $picarr = $goods['pc_src'];
            $imgarr = implode(',',$picarr);
            $flag = $goods['like'];
            $goods_flag = implode(",",$flag);
            /*存入商品信息*/
            /*创建商品信息*/
            $goodsdata = [
              'id' => $goods['id'], //商品ID
              'mid' => $goods['mid'], //菜单ID
              'title' => $goods['title'], //商品标题
              'entitle' => $goods['entitle'], //商品英文标题
              'picurl' => $goods['picurl'], //商品缩略图
              'picarr' => $imgarr,//商品组图
              'content' => $content['content'], //商品详情
              'shop_content' => $shop['shopcontent'], //商品售后详情
              'price' => $goods['price'],
              'old_price' => $goods['old_price'],
              'vip_price' => $goods['vip_price'],
              'is_phone' => $goods['is_phone'],
              'status' => $goods['status'],

            ];

            /*存入商品sku*/
            $this->db->table("goods_jf_sku")->where(array("goods_id"=>$attr[0]['item_id']))->del();
            foreach ($attr as $item) {
                $data = [
                  'goods_id' => $item['item_id'],
                  'attr_key' => $item['symbol'],
                  'jf' => $item['jf'],
                  'housnum' => $item['housnum'],
                  'picurl' => $item['imgurl'],
                  'sku' => $item['sku']
                ];

                $this->db->table('goods_jf_sku')->insert($data);
            }

        }

      }

   }


 ?>

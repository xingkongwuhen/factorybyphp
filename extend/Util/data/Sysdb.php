<?php
  namespace Util\data;
  use think\Db;

  /**
   *
   */
  class Sysdb
  {
    //table代表的是数据表名称
    public function table($table)
    {
      $this->where = array();//将where条件清空，初始化
      $this->field = '*';//初始化
      $this->order = '';
      $this->table = $table;
      return $this;
    }
    //指定查询的数据为
    public function field($field = '*')
    {
      $this->field = $field;
      return $this;
    }
    //where条件
    public function where($where = array())
    {
      $this -> where = $where;
      return $this;
    }

    //返回一条记录
    public function info()
    {
      $info = Db::name($this->table)->field($this->field)->where($this->where)->find();

      return $info ? $info : false;
    }

    //查询列表
    public function lists()
    {
      $query = Db::name($this->table)->field($this->field)->where($this->where)->order($this->order)->select();
      // $this->order && $query = $query->order($this->order);
      $lists = $query;
      return $lists ? $lists : false;
    }
    //保存数据
    public function insert($data)
    {
      $res = Db::name($this->table)->insert($data);
      return $res ? $res : false;
    }

    //自定义返回数据的索引
    public function cates($index)
    {
      $query = Db::name($this->table)->field($this->field)->where($this->where)->order($this->order)->select();
      // $this->order && $query = $query;
      $lists = $query;
      if(!$lists)
      {
        return false;
      }
      $results = [];
      foreach($lists as $key => $value)
      {
        $results[$value[$index]] = $value;
      }
      return $results;
    }

    //更新操作
    public function update($data)
    {
      $res = Db::name($this->table)->where($this->where)->update($data);
      return $res ? $res : false;
    }
    //删除操作
    public function del()
    {
      $res = Db::name($this->table)->where($this->where)->delete();
      return $res ? $res : false;
    }
    //排序
    public function order($order)
    {
      $this->order = $order;
      return $this;
    }
    //分页函数
    public function pages($pagesize = 10)
    {
      $totals =  Db::name($this->table)->where($this->where)->count();
      $query = Db::name($this->table)->field($this->field)->where($this->where);
      $this->order && $query = $query->order($this->order);
      $data = $query->paginate($pagesize,$totals);
      return array("total"=>$totals,'lists'=>$data->items(),'pages'=>$data->render());

    }
    /*获取当前数据的最大数值*/
    public function max($x = 'id')
    {
      $res = Db::name($this->table)->where($this->where)->max($x);
      return $res ? $res : '0';
    }
    /*获取插入数据后返回的ID*/
    public function insertGetId($data)
    {
      $res = Db::name($this->table)->insertGetId($data);
      return $res ? $res : false; 
    }

  }


 ?>

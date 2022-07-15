<?php
  namespace app\admin\controller;
  use app\admin\controller\Base;

  /**
   *
   */
  class Upload extends Base
  {

    //图片上传
    public function img()
    {
        $maxsize = 6000000;  //上传最大图片 6M
        $file = request()->file('file');
        // var_dump($file); die();
          if($file == null){
            $status = 0;
            $msg = "需要上传的文件找不到了！！";
          }
          $imgtype = str_replace("image/","",$file -> getInfo()['type']); //上传文件类型
          $imgsize = $file -> getInfo()['size']; //上传文件大小
            //判断上传图片的大小
          if($imgsize < $maxsize)
          {
              //判断上传类型
              $type = array("jpeg","jpg","png","gif");

              if(in_array($imgtype,$type))
              {

                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/img');

                if($info)
                {

                  $status = 1;

                  $msg = '/public/uploads/img/'.$info->getSaveName();
                  // var_dump($img); die();
                  // $msg = json_encode($img);
                	// exit(json_encode(array('code'=>0,'msg'=>$msg)));
                }else{

                  $status = 0;

                  $msg = "上传失败";
                }

              }else{

                $status = 0;

                $msg = "文件上传格式不正确，请上传 jpg/jpeg/png/gif等格式";

              }

          }else{

            $status = 0;

            $msg = "图片大小超出6M,请处理后在上传！";

          }
          return json_encode(array('status'=>$status,'msg'=>$msg));
    }

    //图片上传
    public function video()
    {
        $size = 6;  //上传最大视频 600M
        $maxsize = $size * 100 * 1024 * 1000 * 1024;
        $file = request()->file('file');
        // var_dump($file); die();
          if($file == null){
            $status = 0;
            $msg = "需要上传的文件找不到了！！";
          }
          $imgtype = str_replace("video/","",$file -> getInfo()['type']); //上传文件类型
          $imgsize = $file -> getInfo()['size']; //上传文件大小
            //判断上传图片的大小
          if($imgsize < $maxsize)
          {
              //判断上传类型
              $type = array("mp4","avi","rmb","rmvb","flv");

              if(in_array($imgtype,$type))
              {

                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/video');

                if($info)
                {

                  $status = 1;

                  $msg = '/public/uploads/video/'.$info->getSaveName();
                  // var_dump($img); die();
                  // $msg = json_encode($img);
                  // exit(json_encode(array('code'=>0,'msg'=>$msg)));
                }else{

                  $status = 0;

                  $msg = "上传失败";
                }

              }else{

                $status = 0;

                $msg = "文件上传格式不正确，请上传 mp4/avi/rmb/rmvb/flv等格式";

              }

          }else{

            $status = 0;

            $msg = "视频大小超出600M,请处理后在上传！";

          }
          return json_encode(array('status'=>$status,'msg'=>$msg));
    }


  }



 ?>

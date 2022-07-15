
## ***Thinkphp5对接阿里云短信接口，不使用官方demo***
**阿里云提供的最新对接api 个人感觉太过复杂不是很容易懂，所以根据官方接口和网上的资料整合一下阿里云发送短信的接口。**
```php
/**
 * @xk 重新定义阿里云相关接口 api 第一个就是阿里云相关短信接口
 * 包含短信的验证码发送和通知类的短信
 * @actor xingkongyinzhe
 * @time 2019-11-13 周三 青岛 天气 小雨转多云
 * @var [type]
 */
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;

/**
 * @xk 开始执行定义短信发送方案
 */
class Aliyun extends Controller
{
    /**
     * 构造公共函数
     */
    function __construct(){
      $this->al_id = ''; //阿里云ID
      $this->al_access = ''; //阿里云密钥
      $this->al_signName = ''; //阿里云配置的模板名称
      $this->al_signCode = ''; //阿里云模板ID  阿里云通知短信模板
      $this->al_signMsgCode = ''; //阿里云通知短信模板
      $this->al_version = '2017-05-25'; //阿里云版本号
    }
    /**
     * @xk 发送验证码 使用阿里云相关短信接口
     * @param  [type] $phone
     * @return [type]        [description]
     */
    public function sendCode($phone=''){
      if(!preg_match("/^1[34578]{1}\d{9}$/",$phone)){
        return Json(array('code'=>0,'msg'=>'手机号格式错误'));
        exit();
      }
      $code = rand(1111,9999);
      $templateparam = [
        'code'=>$code
      ];
      $params = array (
          'SignName' => $this->al_signName, //阿里云短信模板
          'Format' => 'JSON',
          'Version' => $this->al_version,
          'RegionId' => 'cn-hangzhou', //短信
          'AccessKeyId' => $this->al_id, //阿里云APPID
          'SignatureVersion' => '1.0',//签名算法版本
          'SignatureMethod' => 'HMAC-SHA1',//签名方式
          'SignatureNonce' => uniqid (),
          'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'), //请求时间戳 格式化输出2019-11-13T12:12:12Z
          'Action' => 'SendSms', //API名称
          'TemplateCode' => $this->al_signCode,
          'PhoneNumbers' => $phone, //电话
          'TemplateParam' => json_encode($templateparam)//更换为自己的实际模版
      );
      // dump($params); die();
      // 计算签名并把签名结果加入请求参数
      $params ['Signature'] = $this->makeMsgSign($params, $this->al_access);  //阿里云appscript
      $url = 'http://dysmsapi.aliyuncs.com/?' . http_build_query ( $params );
      $ch = curl_init ();
      curl_setopt ( $ch, CURLOPT_URL, $url );
      curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
      curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
      curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
      $result = curl_exec ( $ch );
      curl_close ( $ch );
      $result = json_decode ( $result, true );
      if (  $result ['Code'] != 'OK') {
          return Json(array('code'=>1,'msg'=>'验证码发送失败，请重新发送'));
      }else{
        Session::set('code',$code);
        return Json(array('code'=>1,'msg'=>'验证码发送成功，请在有效时间内填写'));
      }
    }
    /**
     * @xk 发送通知短信 使用阿里云短信接口发送相关通知短信包含
     * @param  [type] $phone
     * @param  [type] $name
     * @param  [type] $tel
     * @param  [type] $content
     * @return [type]          [description]
     */
    public function sendMsg($phone,$name,$tel,$content){
      $templateparam = [
        'name'=>$name,
        'tel'=>$tel,
        'content'=>$content
      ];
      $params = array (
          'SignName' => $this->al_signName, //阿里云短信模板
          'Format' => 'JSON',
          'Version' => $this->al_version,
          'RegionId' => 'cn-hangzhou', //短信
          'AccessKeyId' => $this->al_id, //阿里云APPID
          'SignatureVersion' => '1.0',//签名算法版本
          'SignatureMethod' => 'HMAC-SHA1',//签名方式
          'SignatureNonce' => uniqid (),
          'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'), //请求时间戳 格式化输出2019-11-13T12:12:12Z
          'Action' => 'SendSms', //API名称
          'TemplateCode' => $this->al_signMsgCode,
          'PhoneNumbers' => $phone, //电话
          'TemplateParam' => json_encode($templateparam)//更换为自己的实际模版
      );
      // dump($params); die();
      // 计算签名并把签名结果加入请求参数
      $params ['Signature'] = $this->makeMsgSign($params, $this->al_access);  //阿里云appscript
      $url = 'http://dysmsapi.aliyuncs.com/?' . http_build_query ( $params );
      $ch = curl_init ();
      curl_setopt ( $ch, CURLOPT_URL, $url );
      curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
      curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
      curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
      $result = curl_exec ( $ch );
      curl_close ( $ch );
      $result = json_decode ( $result, true );
      if (  $result ['Code'] != 'OK') {
          return false;
      }
      return true;
    }
    /**
     * @xk 生成阿里云短信发送签名
     * @actor xingkongyinzhe
     * @time 2019-11-13 周三 青岛 天气 小雨转多云
     * @param  [type] $data   要生成的签名数组
     * @param  [type] $al_access  阿里云提供的短信签名
     * @return [type]            [description]
     */
    private function makeMsgSign($data,$al_access){
      ksort($data); //对关联数组按照键名进行升序排序。
      $string= ''; //初始化 生成的请求串
      // 使用&和=将请求数组转化为字符串
      foreach ($data as $key => $value ) {
        $string.='&'.urlencode($key).'='.urlencode($value);
      }
      $stringToSign = 'GET&'.urlencode('/').'&' . urlencode(substr($string, 1)); //根据阿里云规则生成要执行签名的字符串
      $sign = base64_encode(hash_hmac('sha1', $stringToSign, $al_access.'&', true ) );
      return $sign;
    }

}

```

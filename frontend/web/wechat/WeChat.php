<?php
class WeChat{
    protected $appid;
    protected $appsecret;
    public function __construct($appid,$appsecret) {
        //给appid和appsecret赋值
        $this->appid = $appid;
        $this->appsecret = $appsecret;

        //自动调用消息处理函数
        // $this->responseMsg();
    }
    //token验证
    public function valid() {
        $echostr = $_GET['echostr'];
        if($this->checkSignature()) {
            header('content-type:text');   
            ob_clean();
            echo $echostr;
        }else {
            echo "error";
            exit;
        }
    }
    //token验证规则
    public function checkSignature() {
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        //字典序排序
        $tmpArr = array(TOKEN,$timestamp,$nonce);
        sort($tmpArr,SORT_STRING);
        //拼接字符串sha1加密
        $tmpStr = join($tmpArr);
        $tmpStr = sha1($tmpStr);
        //加密签名的比较
        if ($tmpStr == $signature) {
            return true;
        }else {
            return false;
        }
    }
    // 获取access_token
	public function get_access_token(){
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appsecret}";
		$request=$this->https_request($url);
        // var_dump($request);
        // exit;
		//echo $request['access_token'];
		return $request['access_token'];
	}

	// 模拟gei请求·和post请求
	function https_request($url,$type='post',$res='json',$data = ''){
        //1.初始化curl
        $curl = curl_init();
        //2.设置curl的参数
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if ($type == "post"){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        //3.采集
        $output = curl_exec($curl);
        //4.关闭
        curl_close($curl);
        if ($res == 'json') {
            return json_decode($output,true);
        }
}    
    // 创建菜单
	public function menu_create($data){
		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$this->get_access_token()}";
		return $request=$this->https_request($url,'post','json',$data);

	}
}

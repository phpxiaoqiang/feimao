<?php 
/*
亲爱的刘珊珊家长，老师已完成对您孩子的点名
状态：正常
上课时间：16:00-17:30
上课班级：少儿民族舞1班
上课老师：李小兵
点击后查看详情，如有疑问请和学校老师联系
*/
class Template{
	private $all;
	private $appid = "wx2525ccd5ac0abcbf";
	private $appsecret = "289d1a2b966723e8b403cf0889c17f42";
	public function __construct() {
		// $this->all = $all;
	}
	public function send() {
		// $arr = $this->all;
		
		$access_token = $this->get_access_token();
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='. $access_token;
		$data = array(
		    'first' => array(
		        'value' => '亲爱的刘珊珊家长，老师已完成对您孩子的点名',
		    ),
		    'keyword1' => array(
		        'value' => '正常',
		    ),
		    'keyword2' => array(
		        'value' => "16:00-17:30",
		    ),
		    'keyword3' => array(
		        'value' => "少儿民族舞1班",
		    ),
		    'keyword4' => array(
		        'value' => "李小兵",
		    ),
		    'remark' => array(
		        'value' => "点击后查看详情，如有疑问请和学校老师联系",
		    )
		);

		$template_msg=array('touser'=>'oexhm1MQumtJaocNYUYPyVJBencw','template_id'=>'r0NuwceuhGi7wrz9062ZGc7qc6c_DTmG5doWok_6TQk','topcolor'=>'#FF0000','data'=>$data);
		$curl = curl_init($url);
		$header = array();
		$header[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg));
		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
				
	}
	public function get_access_token(){
		
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appsecret}";
		$request=$this->https_request($url);
	    // var_dump($request);
	    // exit;
		return $request['access_token'];
	}

	// 模拟gei请求·和post请求
	public function https_request($url,$type='post',$res='json',$data = ''){
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

}
//  $arr = Array
// 		(
// 		    'student_name' => '奋斗的',
// 		    'class' => 'HIPOP212',
// 		    'class_table' => '每周一12点，阿萨达',
// 		    'teacher' => '郭晶晶',
// 		    'one_time' => '1',
// 		    'one_money' => '5.0454545454545',
// 		    'tot_money' => '0',
// 		    'tot_time' => '0',
// 		    's_hours' => '22',
// 		    's_money' => '111'
// 		);
(new Template())->send();
 ?>
<?php
define("TOKEN","weixin1");
$wechatobj=new wechatCallbackapiTest();
//(1)����֤
$wechatobj->valid();
//(2)��֤�ɹ���ע�͵�valid(),�����Զ��ظ�����
//$wechatobj->responseMsg();
class wechatCallbackapiTest
{
    public function valid(){
        $echoStr=$_GET["echostr"];
        //�����û�����ǩ����֤
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    //�����Զ��ظ�����
    public function responseMsg(){
        //�����û��˷��͵�XML����
        $postStr=$GLOBALS["HTTP_RAW_POST_DATA"];
        //�ж�XML�����Ƿ�Ϊ��
        if(!empty($postStr)){
            libxml_disable_entity_loader(true);
            //ͨ��simplexml����xml����
            $postObj=simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
           //΢���ֻ���
            $fromUsername=$postObj->FromUserName;
           //΢�Ź���ƽ̨
            $toUsername=$postObj->ToUserName;
            //�����û����͹ؼ���
            $keyword=trim($postObj->Content);
            $time=time();
            $textTpl="<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[%s]]></MsgType>
                      <Content><![CDATA[%s]]></Content>
                      <FuncFlag>0</FuncFlag>
                      </xml>";
            if(!empty($keyword)){
                $msgType="text";
                $contentStr="Welcome to wechat world!";
                $resultStr=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }
        }else{
            echo "";
            exit;
        }
    }

    private function checkSignature(){
        //�ж�token��Կ�Ƿ�����
        if(!defined("TOKEN")){
            throw new Exception('TOKEN is not defined');
        }
        $signature=$_GET["signature"];//΢�ż���ǩ��
        $timestamp=$_GET["timestamp"];//ʱ����
        $nonce=$_GET["nonce"];//������
        $token=TOKEN;
        $tmpArr=array($token,$timestamp,$nonce);
       //ͨ���ֵ䷨��������
        sort($tmpArr,SORT_STRING);
        $tmpStr=implode($tmpArr);
        $tmpStr=sha1($tmpStr);
        if($tmpStr==$signature){
            return true;
        }else{
            return false;
        }
    }
}

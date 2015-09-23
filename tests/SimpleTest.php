<?php
date_default_timezone_set('Asia/Shanghai');
use ddliu\wxpay\Config;
class SimpleTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $configs = include(__DIR__.'/config.php');
        Config::setGlobal($configs);
    }

    public function testNativePay() {
        $notify = new \ddliu\wxpay\NativePay();
        $url = $notify->GetPrePayUrl("123456789");
        echo $url.PHP_EOL;

        $input = new \ddliu\wxpay\Data\UnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no('pre_'.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        echo $url2.PHP_EOL;
    }


}
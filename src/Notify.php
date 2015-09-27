<?php
namespace ddliu\wxpay;
use ddliu\wxpay\Data\NotifyReply;
use ddliu\wxpay\Api;
use ddliu\wxpay\Data\Results;

/**
 * 回调基础类
 */
class Notify
{
    protected $lastError;

    public function getLastError() {
        return $this->lastError;
    }

    /**
     * 检查微信通知是否合法
     * @param  string $rawData 通知的原始数据，如果不传则从请求中获取
     * @return array|false 通知的数据，数据非法则返回false
     */
    public function checkNotifyData($rawData = null) {
        if ($rawData === null) {
            $rawData = file_get_contents("php://input");
        }

        try {
            $result = Results::Init($rawData);
        } catch (Exception $e){
            $this->lastError = $e->errorMessage();
            return false;
        }

        return $result;
    }

    public function replySuccess($needSign = true) {
        $reply = new NotifyReply();
        $reply->SetReturn_code('SUCCESS');
        $reply->SetReturn_msg('OK');
        if ($needSign) {
            $reply->SetSign();
        }
        Api::replyNotify($reply->ToXml());
    }

    public function replyFail($msg = 'ERROR') {
        $reply = new NotifyReply();
        $reply->SetReturn_code('FAIL');
        $reply->SetReturn_msg($msg);
        Api::replyNotify($reply->ToXml());
    }
}
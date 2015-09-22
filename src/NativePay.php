<?php
namespace ddliu\wxpay;

use ddliu\wxpay\Data\BizPayUrl as BizPayUrlData;

/**
 * 刷卡支付实现类
 */
class NativePay
{
    /**
     * 
     * 生成扫描支付URL,模式一
     * @param BizPayUrlInput $bizUrlInfo
     */
    public function GetPrePayUrl($productId)
    {
        $biz = new BizPayUrlData();
        $biz->SetProduct_id($productId);
        $values = Api::bizpayurl($biz);
        $url = "weixin://wxpay/bizpayurl?" . $this->ToUrlParams($values);
        return $url;
    }
    
    /**
     * 
     * 参数数组转换为url参数
     * @param array $urlObj
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            $buff .= $k . "=" . $v . "&";
        }
        
        $buff = trim($buff, "&");
        return $buff;
    }
    
    /**
     * 
     * 生成直接支付url，支付url有效期为2小时,模式二
     * @param UnifiedOrderInput $input
     */
    public function GetPayUrl($input)
    {
        if($input->GetTrade_type() == "NATIVE")
        {
            $result = Api::unifiedOrder($input);
            return $result;
        }
    }
}
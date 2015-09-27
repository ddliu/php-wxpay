# php-wxpay

微信支付PHP SDK

## 安装

```
composer require ddliu/wxpay
```

## 使用

### 配置

```
use ddliu\wxpay\Config;

// 全局配置
Config::setGlobal([
    'APPID' => 'wx426b3015555a46be',
    'MCHID' => '1225312702',
    'KEY' => 'e10adc3949ba59abbe56e057f20f883e',
    'APPSECRET' => '01c6d59a3f9024db6336662ac95c8e74',
]);
```

### 通知示例

```php
use ddliu\wxpay\Notify;

$notify = new Notify();
$data = $notify->checkNotifyData();
if (!$data) {
    // 检查通知数据失败
    $notify->replyFail();
} elseif ($data['result_code'] == 'SUCCESS') {
    // 支付成功
    $orderNo = $data['out_trade_no'];

    // 查询数据库取得订单信息
    // $order = query_my_order($orderNo);

    // 处理成功逻辑

    // 响应通知
    $notify->replySuccess();
} else {
    // 处理失败逻辑
    // 检查通知数据失败
    $notify->replyFail();
}
```

## 关于

本库基于[微信官方PHP SDK](https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=11_1)，使用的代码版权归原作者所有

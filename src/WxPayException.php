<?php
namespace ddliu\wxpay;

class Exception extends \Exception {
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
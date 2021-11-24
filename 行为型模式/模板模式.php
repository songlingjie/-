<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/24/21
 * Time: 10:07 AM
 */


/**
 * 定义：在一个方法中定义算法（这里只抽象上的业务）的骨架，将某些步骤推迟到子类中实现
 * 举例：比如 支付类中定义基础的支付方法 和 一个抽象的请求第三方系统方法，继承支付类的子类来是实现这个抽象方法
 */


/**
 * 支付基类
 * Class BasePayment
 */
abstract class BasePayment
{
    public function doPayment($order)
    {
        // 处理公共逻辑

        // 请求第三方支付系统
        $this->callThirdSys($order);

        //返回请求成功响应
        return $this->sucResult();
    }

    abstract function callThirdSys($order);

    private function sucResult()
    {
        return [
            'status' => 'success'
        ];
    }
}


class AilpayPayment extends BasePayment
{
    public function callThirdSys($order)
    {
        // do something
    }
}


class WechatPayment extends BasePayment
{
    public function callThirdSys($order)
    {
        // do something
    }
}
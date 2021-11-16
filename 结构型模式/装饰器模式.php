<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/10/21
 * Time: 10:02 AM
 */

interface people
{
    public function eating();
}


/**
 * 定义：在不改变原有类的接口的条件下 对原有类进行增强, 并支持多个装饰器嵌套使用
 * 举例：laravel框架中的中间件
 */


interface BaseRequest
{
    public function handle();
}

class Request implements BaseRequest
{
    public function handle()
    {
        echo "handle request";
    }
}

class VerifyToken implements BaseRequest
{

    protected $request;

    public function __construct(BaseRequest $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        echo "验证token\n";
        $this->request->handle();
    }
}

class AccessLog implements BaseRequest
{

    protected $request;

    public function __construct(BaseRequest $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        echo "记录日志\n";
        $this->request->handle();
    }
}

$request = new Request();

$accessLog = new AccessLog($request);

$verifyToken = new VerifyToken($accessLog);

$verifyToken->handle();


<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/9/21
 * Time: 10:02 AM
 */

/**
 * 定义：在不改变原有类的接口的条件下，为原始类定义一个代理类。 其主要目的是控制访问而非增强功能，这是它和装饰器模式的最大区别
 *
 */

/**
 * Class UserController
 */

class UserController
{
    public function login($userName, $userPwd)
    {
        echo $userName. $userPwd . "\n";
    }
}

/**
 * 静态代理
 * Class UserControllerProxy
 */
class UserControllerProxy
{
    private $userController;

    private function __construct(UserController $controller) {
        $this->userController = $controller;
    }

    public function login()
    {
        // do something
        $this->userController->login();
        // do something
    }
}

/**
 * 动态代理
 * Class proxy
 */
class proxy
{
    private $className;

    public function __construct($className)
    {
        $this->className = new $className;
    }

    /**
     * @param $name
     * @param $arguments
     * @throws ReflectionException
     */
    public function __call($name, $arguments)
    {
        $ref = new ReflectionClass($this->className);
        if ($method = $ref->getMethod($name)) {
            if ($method->isPublic()){
                // do something
                echo "登录开始\n";
                $method->invokeArgs(new $this->className, $arguments);
                // do something
                echo "登录结束\n";
            }
        }
    }
}

$p = new proxy('UserController');
$p->login('songlingjie', '11111');


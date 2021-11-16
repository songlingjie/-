<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/15/21
 * Time: 10:34 AM
 */

/**
 * 定义：子系统提供一组统一的接口，定义一组高层接口让子系统更易用
 * 举例：比用户注册成功后需要给用户开通钱包，这是我们可以封装一个注册门面 一次调用注册 和开通钱包接口，减少一次网络请求。还有一个更恰当的例子是首页的信息流接口
 * 思考：解决多接口调用产生的问题
 */

class UserRegisterParams
{
    public $userName;

    public function __construct($userName)
    {
        $this->userName = $userName;
    }
}

class UserRegister
{
    /**
     * @var UserRegisterParams 用户注册参数
     */
   private $userRegisterParams;


   private $uid;

   public function __construct(UserRegisterParams $userRegisterParams)
   {
       $this->userRegisterParams = $userRegisterParams;
   }

   public function handel()
   {
       $this->uid = range(1,9999);
       echo $this->userRegisterParams->userName. "注册成功\n";
   }

   public function getUid()
   {
       return $this->uid;
   }
}

class UserBalanceRegister
{
    private $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    public function handle()
    {
        echo "钱包注册成功";
    }
}

class UserRegisterFacade
{
    public function handel($name)
    {
        $userRegisterParams = new UserRegisterParams($name);

        $userRegister = new UserRegister($userRegisterParams);
        $userRegister->handel();
        $uid = $userRegister->getUid();

        $userBalanceRegister = new UserBalanceRegister($uid);
        $userBalanceRegister->handle();
    }
}

$userName = '宋玲杰';
$userRegister = new UserRegisterFacade();
$userRegister->handel($userName);



<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/26/21
 * Time: 10:04 AM
 */


/**
 * 定义：定义一族算法类，将每个算法分别封装起来，让它们可以互相替换
 * 工厂模式是解耦对象的创建和使用，观察者模式是解耦观察者和被观察者。策略模式跟两者类似，不过，它解耦的是策略的定义、创建、使用这三部分
 * 举例：比如根据订单类型 计算优惠金额
 * 思考：其实就是利用查表法 来代替 ifesle，使其满足开闭原则，有新策略的时候最小化的改动代码
 */


/**
 * 计算订单优惠金额接口
 * Interface DiscountStrategy
 */
interface DiscountStrategy
{
    public function getDiscount($order);
}

/**
 * 普通订单计算优惠金额
 * Class NormalDiscountStrategy
 */
class NormalDiscountStrategy implements DiscountStrategy
{
    public function getDiscount($order)
    {
        // 普通订单计算优惠金额实现逻辑
    }
}

/**
 * 团购订单计算优惠金额
 * Class GroupBuyDiscountStrategy
 */
class  GroupBuyDiscountStrategy implements DiscountStrategy
{
    public function getDiscount($order)
    {
        // 团购订单计算优惠金额实现逻辑
    }
}

/**
 * 获取实例的工厂
 * Class DiscountStrategyFactory
 */
class DiscountStrategyFactory
{
    public  static $instances = [];

    public static $orderType2StrategyMap = [
        'normal' => NormalNotification::class,
        'groupBuy' => GroupBuyDiscountStrategy::class,
    ];

    /**
     * @param $orderType
     * @return DiscountStrategy
     * @throws Exception
     */
    public static function getInstance($orderType)
    {
        if (!isset(self::$instances[$orderType])) {
            if (!isset(self::$orderType2StrategyMap[$orderType])) {
                throw  new Exception("not support order type". $orderType);
            }
            self::$instances[$orderType] = self::$orderType2StrategyMap[$orderType];
        }
        return self::$instances[$orderType];
    }
}

// 策略模式使用

class OrderDetail
{

    public function getDiscountAmount($order)
    {
        $orderType = $order->order_type;
        $discountStrategy = DiscountStrategyFactory::getInstance($orderType);
        return $discountStrategy->getDiscount($order);
    }
}



<?php
/**
 * Created by PhpStorm
 * User: songlingjie
 * Date: 11/19/21
 * Time: 10:10 AM
 */


/**
 * 监听者接口
 * Interface ListenInterface
 */
interface ListenInterface
{
    public function handle();
}

/**
 * 触发事件接口
 * Interface EventInterface
 */
interface EventInterface
{
    public function setListener(ListenInterface $listen);
}


/**
 * 注册事件
 * Class RegEvent
 */
class RegEvent implements EventInterface
{

    protected $listens = [];

    public function setListener(ListenInterface $listen)
    {
        $this->listens[] = $listen;
    }

    public function handle()
    {
        foreach ($this->listens as $listen)
        {
            $listen->handle();
        }
    }
}

/**
 * 注册事件监听者
 * Class SendMailListener
 */
class SendMailListener implements ListenInterface
{
    public function handle()
    {
        echo "发送邮件\n";
    }
}

/**
 * 推送到数据监测中心
 * Class SendMailListener
 */
class PushDataListener implements ListenInterface
{
    public function handle()
    {
        echo "推送数据\n";
    }
}

//test
$regEvent = new RegEvent();
$regEvent->setListener(new SendMailListener());
$regEvent->setListener(new PushDataListener());
$regEvent->handle();
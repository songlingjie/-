<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/10/21
 * Time: 10:22 AM
 */

/**
 * 定义：一个类存在两个变化维度，我们通过组合的方式让这两个类独立的进行扩展
 * 举例：比如api监控告警功能，根据不同的告警规则发送不同类型告警， 比如严重时电话提醒，普通类型邮件提醒
 * 不同的告警规则 发送不同的提醒
 */


/**
 * 提醒接口
 * Interface MsgSender
 */
interface MsgSender
{
    public function send($message);
}

/**
 * 发送网络电话提醒
 * Class TelephoneMsgSender
 */
class TelephoneMsgSender implements MsgSender
{

    private $tel;

    public function __construct($tel)
    {
        $this->tel = $tel;
    }

    public function send($message)
    {
        // TODO: Implement send() method.
        // 发送短信提醒
        echo $this->tel . " " . $message . "\n";

    }
}

/**
 * 发送邮件
 * Class EmailMsgSender
 */
class EmailMsgSender implements MsgSender
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function send($message)
    {
        // TODO: Implement send() method.
        // 发送邮件提醒
        echo $this->email . " " . $message . "\n";
    }
}

abstract class Notification
{

    protected $msgSender;

    public function __construct(MsgSender $msgSender)
    {
        $this->msgSender = $msgSender;
    }

    abstract function notify($msg);
}


class SevereNotification extends Notification
{

    public function __construct(MsgSender $msgSender)
    {
        parent::__construct($msgSender);
    }

    public function notify($msg)
    {
        // TODO: Implement notify() method.
        $this->msgSender->send($msg);
    }
}

class NormalNotification extends Notification
{
    public function __construct(MsgSender $msgSender)
    {
        parent::__construct($msgSender);
    }

    public function notify($msg)
    {
        // TODO: Implement notify() method.
        $this->msgSender->send($msg);
    }
}

// test
$tel = '13888888888';
$severeNotification = new SevereNotification(new TelephoneMsgSender($tel));
$severeNotification->notify('severe  bug');

$email = 'songlingjie163@gmail.com';
$normalNotification = new NormalNotification(new EmailMsgSender($email));
$normalNotification->notify('normal  bug');


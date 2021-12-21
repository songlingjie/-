<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 12/8/21
 * Time: 9:56 AM
 */


/**
 * 有限状态机有三个组成部分：状态，事件，动作。事件触发状态的转移以及动作的执行，执行动作并不是必须的，也可以只转移状态不执行动作
 *  以下🌰参考极客时间王铮的设计模式之美
 *  小玛丽奥，超级马里奥是状态，吃🍄是事件，分数增加减少是动作。 小马里奥吃🍄变成超级马里奥，相应的分数增加。
 */


// 马里奥接口类
interface IMario
{
    public function getStatus();

    // 以下是事件抽象

    // 吃蘑菇
    public function obtainMushRoom();

    // 遇见怪物
    public function meetMonster();
}

// 马里奥状态机类
class MarioStateMachine
{
    /**
     * @var int 分数
     */
    private $score;

    /**
     * @var IMario $currentState 当前状态
     */
    private $currentState;

    /**
     * MarioStateMachine constructor.
     */
    public function __construct()
    {
        $this->currentState = new SmallMario($this);
    }

    /**
     * @param IMario $mario
     */
    public function setCurrentState(IMario $mario)
    {
        $this->currentState = $mario;
    }

    /**
     * @return string
     */
    public function getCurrentState()
    {
        return $this->currentState->getStatus();
    }

    /**
     * @param integer $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * 获得蘑菇事件
     */
    public function obtainMushRoom()
    {
        $this->currentState->obtainMushRoom();
    }

    /**
     * 遇到怪物
     */
    public function meetMonster()
    {
        $this->currentState->meetMonster();
    }
}

// 初始的小马里奥
class SmallMario implements IMario
{
    public $stateMachine;

    public function __construct(MarioStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    public function getStatus()
    {
        return 'small';
    }

    public function obtainMushRoom()
    {
        $this->stateMachine->setCurrentState(new SuperMario($this->stateMachine));
    }


    public function meetMonster()
    {
        // do nothing...
    }
}

// 超级马里奥
class SuperMario implements IMario
{
    public $stateMachine;

    public function __construct(MarioStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    public function getStatus()
    {
        return 'super';
    }

    public function obtainMushRoom()
    {
        // do nothing...
    }

    public function meetMonster()
    {
        $this->stateMachine->setCurrentState(new SmallMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() - 100);
    }
}


// test


// 初始化
$stateMachine = new MarioStateMachine();

// 吃蘑菇 变成超级马里奥
$stateMachine->obtainMushRoom();

// 遇到怪物，变成小玛丽
$stateMachine->meetMonster();

// 又吃了蘑菇，变成超级马里奥
$stateMachine->obtainMushRoom();

// 又遇到怪物，变成小玛丽奥
$stateMachine->meetMonster();

echo $stateMachine->getCurrentState(); // small





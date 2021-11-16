<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/16/21
 * Time: 10:06 AM
 */

/**
 * 定义：将一组对象组织成树型结构
 * 举例：比如公司的部门下有子部门和员工
 * 思考：更形象的比喻是一种特定场景下的数据结构
 */
abstract class HumanResource
{
    /**
     * @var integer 员工id
     */
    protected $id;

    /**
     * @var integer 薪水
     */
    protected $salary;

    public function __construct($id)
    {
        $this->id = $id;
    }

    abstract function calculateSalary();
}

/**
 * 员工类
 * Class Employee
 */
class Employee extends HumanResource
{
    public function __construct($id, $salary)
    {
        parent::__construct($id);

        $this->salary = $salary;
    }

    public function calculateSalary()
    {
        // TODO: Implement calculateSalary() method.
        return $this->salary;
    }
}

/**
 * 部门类
 * Class Department
 */
class Department extends HumanResource
{

    protected $nodeList = [];

    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function calculateSalary()
    {
        // TODO: Implement calculateSalary() method.
        $totalSalary = 0;
        foreach ($this->nodeList as $subNode) {
            $totalSalary += $subNode->calculateSalary();
        }
        $this->salary = $totalSalary;

        return $totalSalary;
    }

    public function addNode(HumanResource $humanResource)
    {
        $this->nodeList[] = $humanResource;
    }
}

// test

// 员工1
$maxwell = new Employee('1', '2000');

// 技术部的用户组
$userGroup = new Department('tech.user_group');
$userGroup->addNode($maxwell);

// 技术部
$tech = new Department('tech');
$tech->addNode($userGroup);
echo $tech->calculateSalary();


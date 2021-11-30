<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/30/21
 * Time: 10:19 AM
 */

/**
 * 定义：多个处理器 依次处理同一个请求。一个请求先经过 A 处理器处理，然后再把请求传递给 B 处理器，B 处理器处理完后再传递给 C 处理器，以此类推，形成一个链条。链条上的每个处理器各自承担各自的处理职责，所以叫作职责链模式
 * 举例 敏感词过滤
 */

interface SensitiveWordFilter
{
    public function doFilter($msg);
}

/**
 * 黄色词汇过滤
 * Class SexyWordFilter
 */
class SexyWordFilter implements SensitiveWordFilter
{
    public function doFilter($msg)
    {
        $legal = true;
        // 敏感词过滤算法
        return $legal;
    }
}

/**
 * 政治词汇过滤
 * Class PoliticalWordFilter
 */
class PoliticalWordFilter implements SensitiveWordFilter
{
    public function doFilter($msg)
    {
        $legal = true;
        // 敏感词过滤算法
        return $legal;
    }
}

class SensitiveWordChain
{
    private $sensitiveWordFilter = [];

    public function addFilter(SensitiveWordFilter $filter)
    {
        $this->sensitiveWordFilter[] = $filter;
    }

    public function filter($msg)
    {
        foreach ($this->sensitiveWordFilter as $filter) {
            if (!$filter->doFilter($msg)) {
                return false;
            }
        }
        return true;
    }
}

$sensitiveWordChain = new SensitiveWordChain();
$sensitiveWordChain->addFilter(new SexyWordFilter());
$sensitiveWordChain->addFilter(new PoliticalWordFilter());
$sensitiveWordChain->filter("需要过滤的词汇");
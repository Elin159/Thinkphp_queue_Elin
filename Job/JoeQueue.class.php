<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 12:39
 */
namespace Org\Job;

/**
 * 核心接口
 * Interface JoeQueue
 * @package Org\Job
 */
interface JoeQueue {
    public function pushQueue($listKey = 'default', $message);//压入队列
    public function shiftQueue($listKey, $value);//移出队列
    public function runQueue($listKey);//运行队列(进行遍历)
    public function assemble($job, $listKey = 'default'); //组装数据
    public function delay($time = 0); //延时
    public function execute();//业务逻辑
}
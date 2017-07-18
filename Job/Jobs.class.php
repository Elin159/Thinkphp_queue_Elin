<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 12:50
 */

namespace Org\Job;

/**
 * 处理核心逻辑
 * Class Jobs
 * @package Org\Job
 */
abstract class Jobs extends Execute {
    protected     $time = 0; //延迟多少秒后执行
    protected   $attempts = 0; //尝试多少次后放弃执行 0为不放弃
    public $host = '127.0.0.1'; //redis主机
    public $port = '6379';//redis端口
    public $password = 'password';//redis密码

    /**
     * 设置任务延时时间
     * @param int $time
     * @return int
     */
    public function delay($time = 0) //延时
    {
        $this->time = $time;
        return $this->time;
    }

    /**
     * 尝试运行多少次后放弃执行(发生致命错误时候尝试多少次后抛弃执行并舍弃该任务)
     * @param $attempts
     * @return int
     */
    public function attempts($attempts = 1)
    {
        is_numeric($attempts) && $this->attempts = $attempts;
        return $this->attempts;
    }

    /**
     * 执行方法
     * @return mixed
     */
    abstract public function execute();
}
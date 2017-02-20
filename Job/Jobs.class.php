<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 12:50
 */

namespace Org\Job;


abstract class Jobs extends Execute {
    protected     $time = 0; //延迟多少秒后执行
    protected   $attempts = 0; //尝试多少次后放弃执行 0为不放弃
    public $host = '127.0.0.1';
    public $port = '6379';
    public $password = 'password';

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

    public function attempts($attempts)
    {
        $this->attempts = $attempts;
        return $this->attempts;
    }

    /**
     * 执行方法
     * @return mixed
     */
    abstract public function execute();
}
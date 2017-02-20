<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 15:22
 */
namespace Org\Job;

class addJoe {

    public $jobName;
    protected $listKey;

    public function __construct(Jobs $jobs, $listKey = 'default') {
        $this->jobName = $jobs;
        $this->listKey = $listKey;
    }

    public function delay($time = 0) {
        $this->jobName->delay($time);
        return $this;
    }

    public function push() {
        $message = $this->jobName->assemble(serialize($this->jobName), $this->listKey); //拼装信息
        return $this->jobName->pushQueue($this->listKey, $message);//压入队列
    }
}
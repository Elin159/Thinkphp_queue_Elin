<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 15:22
 */
namespace Org\Job;

//加入队列模型  //连贯操作
class addJoe {

    public $jobName; //队列业务对象
    protected $listKey;

    /**
     * 初始化
     * addJoe constructor.
     * @param Jobs $jobs 队列任务文件
     * @param string $listKey 压进哪个队列(队列名称)
     */
    private function __construct(Jobs $jobs, $listKey = 'default') {
        $this->jobName = $jobs;
        $this->listKey = $listKey;
    }

    /**
     * 任务延时执行
     * @param int $time
     * @return $this
     */
    public function delay($time = 0) {
        $this->jobName->delay($time);
        return $this;
    }

    /**
     * 压入队列
     * @return int
     */
    public function push() {
        $message = $this->jobName->assemble(serialize($this->jobName), $this->listKey); //拼装信息
        return $this->jobName->pushQueue($this->listKey, $message);//压入队列
    }

    /**
     * 选择压入哪个队列
     * @param string $listKey 队列名称
     * @return $this
     */
    public function onQueue($listKey = 'default') {
        $this->listKey = $listKey;
        return $this;
    }

    /**
     * @param Jobs $jobs 队列业务逻辑
     * @param string $listKey 队列名称
     * @return static 返回实例
     */
    public static function Joe(Jobs $jobs, $listKey = 'default') {
        return new static($jobs, $listKey);
    }
}
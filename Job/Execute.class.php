<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 13:11
 */

namespace Org\Job;

use Redis;

abstract class Execute implements JoeQueue {

    public $redis;
    public function __construct()
    {
        $redis = new Redis();
        $redis->connect($this->host, $this->port);
        $result = $redis->auth($this->password);
        if($result) {
            $this->redis = $redis;
        } else {
            return 0;
        }
    }

    /**
     * 弹出队列
     * @param $listKey 队列的组别
     */
    public function shiftQueue($listKey, $value)
    {
        // TODO: Implement shiftQueue() method.
        $this->redis->Lrem($listKey, $value);
//        $this->redis->lTrim($listKey, 1, -1);
    }

    /**
     * 运行队列
     * @param $listKey
     */
    public function runQueue($listKey = 'default')
    {
        // TODO: Implement runQueue() method.
        $redisInfo = $this->redis->lRange($listKey, 0, 5);
        $dataLength = $this->redis->lLen($listKey);
        if($dataLength > 0) {
//            echo 1;
            foreach($redisInfo as $key => $value) {

                $this->shiftQueue($listKey, $redisInfo[$key]); //先弹出队列
                $content = json_decode($value, true);
                if($content['delay'] > 0) {
                    $time = time();
                    $delayTime = $content['add_time'] + $content['delay'] > $time;
                    if(!$delayTime) {
                        $content['delay'] = 0;
                    }
                    $this->redis->rPush($listKey, json_encode($content));
                    continue;
                }
                if($content['listKey'] == $listKey && $content['delay'] == 0 ) {
//                    if($content['attempts'] == $content['run'] && $content['attempts'] != 0) {
//                        //运行次数等于可尝试次数，这时候就丢弃
//                    }
                    if($content['attempts'] == 0 || $content['attempts'] > $content['run']) {
                        $content['run']++;
                        $job = unserialize($content['job']);
                        $job->execute();
                    }
                }
            }
        }
    }

    public function run($listKey = 'default')
    {
        while(1) {
            $this->runQueue($listKey);
        }
    }

    /**
     * 压入队列
     * @param string $listKey 队列的组别
     * @param $message 压入组装后的信息
     * @return int
     */
    public function pushQueue($listKey = 'default', $message)
    {
        // TODO: Implement pushQueue() method.
        $jsonMessage = json_encode($message);
        $rPushResul = $this->redis->rPush($listKey, $jsonMessage); //执行成功后返回当前列表的长度 9
        return $rPushResul;
    }


    /**
     * 组装数据压进队列
     * @param $job 运行的文件路径
     * @param $attempts 尝试次数
     * @param $time 推迟多少时间
     * @param $listKey = default 分哪个组的
     * @return array
     */
    public function assemble($job, $listKey = 'default') //组装数据
    {
        $message = [
            'job'       => $job,
            'attempts'  => $this->attempts,
            'delay'     => $this->time,
            'add_time'  => time(),
            'listKey'   => $listKey,
            'run'       => 0
        ];

        return $message;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 15:36
 */

namespace Org\Job;

class runJoe extends Jobs {

    /**
     * 执行队列(php_cli模式进行)
     */
    public function execute()
    {
        // TODO: Implement execute() method.
        $this->run();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 下午 15:36
 */

namespace Org\Job;
if (!IS_CLI)  die('The file can only be run in cli mode!');
class runJoe extends Jobs {

    public $listKey;

    public function __construct($listKey = 'default')
    {
        parent::__construct();
        $this->listKey = $listKey;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        $this->run($this->listKey);
    }
}
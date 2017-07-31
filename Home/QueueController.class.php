<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23 0023
 * Time: 下午 21:38
 */
namespace Home\Controller;

use Org\Factory\Architect;
use Org\Job\runJoe;

class QueueController extends Architect {

    public function index() {
        $this->receive($_SERVER['argv']);
    }

}
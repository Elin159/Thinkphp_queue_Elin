<?php 
 namespace Job;
use Org\Job\Jobs;
class SmallStick extends Jobs {

    public $attribute;//自定义属性值
    public $host = '127.0.0.1'; //redis主机
    public $port = '6379';//redis端口
    public $password = 'password';//redis密码

    public function __construct($attribute)
    {
        parent::__construct();
        $this->attribute      = $attribute;
    }

    /**
    * 处理逻辑
    */
    public function execute()
    {
       //处理逻辑
        //业务逻辑代码
    }
}
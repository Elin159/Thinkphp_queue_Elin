<?php 
 namespace Job;
use Org\Job\Jobs;
class SmallStick extends Jobs {

    public $attribute;//自定义属性值

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
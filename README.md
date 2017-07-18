Thinkphp_queue_self
====
#尚未开发完成, 请自行选择是否在生产环境使用<br>
<br>
描述
----
本项目是基于redis自带的队列结构而进行封装，暂时封装了listen模式，以及快捷创建队列业务文件功能，<br>

queue:listen 命令<br>
<br>
listen 命令：该命令将会创建一个listen父进程,然后父进程通过 php artisan /Home/queue make:queue name 的方式来创建一个子进程来处理消息队列，且限制该进程的执行时间。 php artisan /Home/queue listen:name
<br>
<br>

##项目代码
###例子:<br>
addJoe::Joe(new SendMail($data['user_id'],$data['email'],$data['content']))->push();<br>

###执行监听:<br>
php artisan /Home/queue listen:email;<br>

###延迟执行:<br>
addJoe::Joe(new SmallStick($data['user_id'],$data['admin_id'],$consume_id))->delay(3)->push();<br>

###指定队列执行:<br>
addJoe::Joe(new SmallStick($data['user_id'],$data['admin_id'],$consume_id))->delay(3)->onQueue('small_stack')->push();<br>


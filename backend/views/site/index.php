<?php

$tody = strtotime(date("Y-m-d"),time());
$start =date('Y-m-d H:i:s',$tody);
$end = date('Y-m-d H:i:s',time());
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>欢迎使用美山子后台管理系统!</h1>

        <p class="lead">此系统用于美山子后台打卡管理、学生管理、老师管理等.</p>

<!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>预约课程管理</h2>

                <p>该页面可用于美山子预约课程的管理，管理员可在此页面修改关于课程的信息.</p>

                <p><a class="btn btn-default" href="/post/index/">转到预约课程管理 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>预约报名管理</h2>

                <p>该页面可用于美山子预约课程的管理，管理员可在此页面修改关于课程的信息.</p>

                <p><a class="btn btn-default" href="/subscribeclass/index">转到预约课程管理 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>卡种管理</h2>

                <p>该页面可用于美山子卡次的管理，管理员可在此页面修改关于卡次的信息.</p>

                <p><a class="btn btn-default" href="/card/index/">转到卡种管理 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>学生管理</h2>

                <p>该页面可用于美山子学生的管理，管理员可在此页面修改关于学生的信息.</p>

                <p><a class="btn btn-default" href="/student/index/">转到学生管理 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>老师管理</h2>

                <p>该页面可用于美山子老师的管理，管理员可在此页面修改关于老师的信息.</p>

                <p><a class="btn btn-default" href="/teacher/index/">转到老师管理 &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>班级管理</h2>

                <p>该页面可用于美山子班级的管理，管理员可在此页面修改关于班级的信息.</p>

                <p><a class="btn btn-default" href="/yrclass/index/">转到班级管理 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>打卡管理</h2>

                <p>该页面可用于美山子打卡的管理，管理员可在此页面查看打卡的信息.</p>

                <p><a class="btn btn-default" href="/opencard/index?start=<?=$start;?>&end=<?=$end;?>">转到订单列表 &raquo;</a></p>
        </div>
            <div class="col-lg-4">
                <h2>系统用户管理</h2>
                <p>该页面可用于美山子系统用户的管理，管理员可在此页面查看相关用户的信息.</p>
                <p><a class="btn btn-default" href="/wxuser/index/">转到用户列表 &raquo;</a></p>
            </div>
        </div>

    </div>
</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */

$this->title = '添加时间表';
$this->params['breadcrumbs'][] = ['label' => '时间表', 'url' => ['index?id=' . $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/layui/css/layui.css">
<script src="/layui/layui.js"></script>
<script src="https://cdn.bootcss.com/date-fns/123/date_fns.js"></script>
<style>
    .demo-input {
        padding-left: 10px;
        height: 38px;
        min-width: 262px;
        line-height: 38px;
        border: 1px solid #e6e6e6;
        background-color: #fff;
        border-radius: 2px;
    }

    #preview {
        height: 38px;
        padding: 0 20px;
        line-height: 38px;
        border: 1px solid #e6e6e6;
        background-color: #fff;
        border-radius: 2px;
    }

    .del_time {
        height: 38px;
        padding: 0 20px;
        line-height: 38px;
        border: 1px solid #e6e6e6;
        background-color: #fff;
        border-radius: 2px;
    }

    #save {
        height: 38px;
        padding: 0 20px;
        line-height: 38px;
        background-color: #009688;
        color: #fff;
        border: none;
        display: none;
    }
</style>
<div class="subscribe-create">
    日期：<input type="text" class="demo-input" placeholder="请选择日期" id="date">
    开始时间：<input type="number" class="demo-input" id="start_time" min="1" max="23" placeholder="开始时间（1-23）">
    结束时间：<input type="number" class="demo-input" id="end_time" min="1" max="23"  placeholder="结束时间（1-23，务必大于开始时间）">
    <button id="preview">预览</button>
    <button id="save">保存</button>
</div>
<div class="subscribe-box">
    <table class="layui-table">
        <thead>
        <tr>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="table_body">

        </tbody>
    </table>
</div>
<script>
    var date1;
    layui.use('laydate', function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#date', //指定元素
            done: function (value, date, endDate) {
                date1 = value
            }
        });
    })

    var dateArr = [];
    $('#preview').on('click', function () {
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();

        if (!date1) {
            layui.use('layer', function () {
                var layer = layui.layer;
                layer.msg('请选择日期');
            })
            return false
        }

        if (!start_time) {
            layui.use('layer', function () {
                var layer = layui.layer;
                layer.msg('请选择开始时间');
            })
            return false
        }

        if (!end_time) {
            layui.use('layer', function () {
                var layer = layui.layer;
                layer.msg('请选择结束时间');
            })
            return false
        }
        if (Number(start_time) >= Number(end_time)) {
            console.log('start_time', start_time)
            console.log('end_time', end_time)
            layui.use('layer', function () {
                var layer = layui.layer;
                layer.msg('结束时间必须大于开始时间');
            })
            return false
        }
        dateArr = [];

        for (let i = Number(start_time); i < Number(end_time); i++) {
            dateArr.push({
                start_time: `${dateFns.format(new Date(`${date1} ${Number(i)}:00:00`), 'YYYY-MM-DD HH:mm')}`,
                end_time: `${dateFns.format(new Date(`${date1} ${Number(i) + 1}:00:00`), 'YYYY-MM-DD HH:mm')}`,
            })
        }
        if (dateArr.length > 0) {
            $('#save').show()
        }
        render(dateArr)
    })

    function render(dateArr) {
        var html = ''
        for (var i = 0; i < dateArr.length; i++) {
            html += `<tr><td>${dateArr[i].start_time}</td><td>${dateArr[i].end_time}</td><td><button class="del_time" data-id=${i}>删除</button></td></tr>`
        }
        $('.table_body').html(html)
    }

    $('body').on('click', '.del_time', function () {
        dateArr.splice($(this).data('id'), 1);
        render(dateArr)
        if(dateArr.length == 0){
            $('#save').hide()
        }
    })

    $('#save').on('click', function () {
        layui.use('layer', function () {
            var layer = layui.layer;
            var index = layer.load(1, {
                shade: [0.1, '#fff'] //0.1透明度的白色背景
            });
        });
        $.ajax({
            url: '/subscribe/ajaxcreate',
            data: {
                uid:<?= $id ?>,
                data: dateArr
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    window.location.href = '/subscribe/index?id=<?= $id ?>';
                } else {
                    window.location.reload()
                }
            },
            error: function (err) {
                console.log(err)
            }
        })
    })

</script>
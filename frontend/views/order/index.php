<?php
use common\models\Category;
use common\models\Teacher;
use common\models\Studentxclass;
use common\models\Yrclass;
use common\models\Opencard;
?>
<style>
    .button {
        background-color: #7d577d; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
        display: block;
        margin: 0 auto;
    }</style>
<div>
    <? if ($model ==''){?>
        <span><center>您好，您需要找老师采购相关课程哦</center></span>
    <?}else{?>
    <div class="container-18">
        <?php if($_GET['id']=='teacher'){ ?>
            <?php foreach ($model as $key=>$value){             //model yr_class
                $cat = Category::find()->where(['id'=>$value['cid']])->one();
                $teacher = Teacher::find()->where(['id'=>$value['teacher_id']])->one();
                ?>
            <div class="order-item">
                <div class="order-card-info">
                    <h3 style="text-align: center; margin: 0;padding: 15px 0 0;font-weight: normal;"><?=$cat->name?></h3>
                    <div class="pay-list">
                        <div class="bd1">
                            <div class="pay-list-item">
                                <span class="key">班级</span>
                                <span class="value"><?=$value['name']?></span>
                            </div>
                            <div class="pay-list-item">
                                <span class="key">上课时间：</span>
                                <span class="value"><?=$value['class_table']?></span>
                            </div>
                            <div class="pay-list-item">
                                <span class="key">总课时：</span>
                                <span class="value"><?=$value['total_hours']?>课时</span>
                            </div>
                            <div class="pay-list-item">
                                <span class="key">课时/每节：</span>
                                <span class="value"><?=$value['hours'];?></span>
                            </div>
                        </div>
                        <div class="bd1">
                            <div class="pay-list-item">
                                <span class="key">舞蹈老师：</span>
                                <span class="value"><?= $teacher->name?></span>
                            </div>
                            <div class="pay-list-item">
                                <span class="key">报名时间：</span>
                                <span class="value"><?=$value['start_time']?></span>
                            </div>

                                <div onclick='<?= 'go_opencard("'.$value['teacher_id'].'","'.$value['id'].'")'; ?>;' class="button">去签到>></div>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php }else{?>
            <?php foreach($model as $item=>$a){
                $Yr  = Yrclass::find()->where(['id'=>$a['c_id']])->one();
                $cate = Category::find()->where(['id'=>$Yr->cid])->one();
                $teacher = Teacher::find()->where(['id'=>$Yr->teacher_id])->one();
                $opencard = Opencard::find()->where(['c_id'=>$a['c_id'],'s_id'=>$a['s_id']])->count();
                $count =$a['hours']+$opencard*$Yr->hours;
//                var_dump($teacher->name);die;
                ?>
        <div class="order-item">
            <div class="order-card-info">
                <h3 style="text-align: center; margin: 0;padding: 15px 0 0;font-weight: normal;"><?=$cate->name?></h3>
                <div class="pay-list">
                    <div class="bd1">
                        <div class="pay-list-item">
                            <span class="key">班级</span>
                            <span class="value"><?=$Yr->name?></span>
                        </div>
                        <div class="pay-list-item">
                            <span class="key">上课时间：</span>
                            <span class="value"><?=$Yr->class_table?></span>
                        </div>

                        <div class="pay-list-item">
                            <span class="key">总课时：</span>
                            <span class="value"><?=$a['total_hours']?>课时</span>
                        </div>
                        <div class="pay-list-item">
                            <span class="key">已上课时：</span>
                            <span class="value"><?=$count?>课时</span>
                        </div>
                    </div>
                    <div class="bd1">
                        <div class="pay-list-item">
                            <span class="key">舞蹈老师：</span>
                            <span class="value"><?php echo $teacher['name'];?></span>
                        </div>
                        <div class="pay-list-item">
                            <span class="key">报名时间：</span>
                            <span class="value"><?=$Yr->start_time?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php } ?>
        <?php }?>
    </div>
    <? }?>
</div>
<script>
    function go_opencard(tid,bid){  //老师的id,与班级的id
        //window.location.href = "/opencard/index?tid="+tid+"&bid="+bid;
        window.location.href = "/punch/index?c_id="+bid;
    }
</script>
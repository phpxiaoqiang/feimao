<?php
$allCategory = array('0' => '视频', '1' => '音频');

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Media */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" href="/webuploader/webuploader.css">
<script src="/webuploader/webuploader.min.js"></script>
<style>
    #uploader {
        display: flex;
    }

    #statusBar {
        width: 500px;
        margin: 0 50px;
    }

    .progress {
        margin-top: 6px !important;
    }

    .stateText {
        margin-top: 5px;
    }
</style>
<div class="media-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?php if (!empty($model->pic)) { ?>
        <div class="form-group field-media-pic required has-error">
            <label class="control-label" for="media-pic">展示图</label>
            <input type="file" id="media-pic" name="Media[pic]" aria-required="true" aria-invalid="true">
            <img src="<?= $model->pic; ?>" style="max-width: 200px;display: block; margin: 15px 0;"/>
        </div>
    <?php } else { ?>
        <?= $form->field($model, 'pic')->fileInput()->label('展示图') ?>
    <?php } ?>
    <div class="form-group field-media-link required">
        <label class="control-label" for="media-link">媒体文件地址</label>
        <div id="uploader" class="wu-example">
            <div class="btns">
                <div id="picker">选择文件</div>
            </div>
            <div id="statusBar"></div>
            <div id="state">
                <p class="stateText"></p>
            </div>
        </div>
        <?php if ($model['link']) : ?>
            <input type="text" id="media-link" class="form-control" name="Media[link]" aria-required="true" readonly
                   value="<?= $model['link'] ?>">
        <?php else: ?>
            <input type="text" id="media-link" class="form-control" name="Media[link]" aria-required="true" readonly>
        <?php endif; ?>
        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'playNum')->textInput() ?>
    <?= $form->field($model, 'type')->dropDownList($allCategory, ['prompt' => '请选择分类']) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'state')->radioList(['1' => '正常', '0' => '隐藏']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(function () {
        var uploader = WebUploader.create({
            swf: '/webuploader/Uploader.swf',
            server: 'http://up.qiniu.com/',
            pick: '#picker',
            resize: false,
            auto: true,
            formData: {
                token: '<?= $token ?>'
            }
        });
        uploader.on('uploadBeforeSend', function (obj, data, headers) {
            data.key = +new Date() + obj.file.name
        })
        uploader.on('uploadProgress', function (file, percentage) {
            var $li = $('#statusBar'),
                $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<div class="progress progress-striped active">' +
                    '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                    '</div>' +
                    '</div>').appendTo($li).find('.progress-bar');
            }

            $('.stateText').text('上传中');

            $percent.css('width', percentage * 100 + '%');
        });
        uploader.on('uploadSuccess', function (file, response) {
            $('.stateText').text('上传完成');
            var url = 'http://ovv0jgblz.bkt.clouddn.com/' + response.key;
            $('#media-link').val(url)
        });

        uploader.on('uploadError', function (file) {
            $('.stateText').text('上传出错');
        });
    })
</script>
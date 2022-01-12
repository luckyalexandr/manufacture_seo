<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('login', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-12 site-signup">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('login', 'Для регистрации на сайте заполните все приведенные поля:') ?></p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('login', 'Имя пользователя (никнейм)')) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('login', 'Пароль')) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('login', 'Зарегистрироваться'), ['class' => 'btn btn-4', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

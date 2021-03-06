<?php

use yii\widgets\Pjax;
use common\models\User;
use common\extensions\Util;
use common\extensions\Btn;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$title = Yii::t('app', 'System user');
$label = Yii::t('app', 'List');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
$keyword = User::getSearchParams('keyword');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('app', 'Search') ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $form = SearchForm::begin(); ?>
                <?= $form->selectPagesize($searchModel) ?>
                <?= $form->selectStatus($searchModel) ?>
                <?= $form->searchKeyword($searchModel) ?>
                <?= Btn::resetButton() ?>
                <?= Btn::searchSubmitButton() ?>
                <?php SearchForm::end(); ?>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right"><?= Btn::createHrefButton() ?></div>
                <h3 class="box-title"><?= $label ?></h3>
            </div>
            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'id'
                        ],
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->username) : $model->username;
                            }
                        ],
                        [
                            'attribute' => 'email',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->email) : $model->email;
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function($model) {
                                return User::getStatusIcon($model->status);
                            },
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'class' => 'backend\widgets\ActionColumn',
                            'header' => Yii::t('app', 'Operation'),
                            'template' => '{delete} {update} {view}',
                            'visibleButtons' => [
                                'update' => function ($model) {
                                    return !User::checkSuperUser($model->id);
                                },
                                'delete' => function ($model) {
                                    return !User::checkSuperUser($model->id);
                                },
                            ]
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
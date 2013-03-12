<?php
    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2) => array('admin'), Yii::t('app', 'Create'),);
?>
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Create') . ' ' . $model->label(),
        'headerIcon' => 'icon-file',
));
$this->renderPartial('_form', array( 'model' => $model, 'buttons' => 'create'));
?>
<?php $this->endWidget();?>

<?php
//    $this->layout = '//layouts/column1';
    // $this->breadcrumbs = array($model->label(2) => array('admin'), Yii::t('app', 'Create'),);
    $this->breadcrumbs = array($model->label(2) => array('admin'), GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)), Yii::t('app', 'Update'),);
?>
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'Update') . ' ' . $model->label()  . ' ' . GxHtml::encode(GxHtml::valueEx($model)),
        'headerIcon' => 'icon-edit',
));
$this->renderPartial('_form', array('model' => $model, 'mode'=>'update', 'buttons' => 'update'));
?>
<?php $this->endWidget();?>
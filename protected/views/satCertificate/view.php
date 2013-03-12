<?php
    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2) => array('admin'),GxHtml::valueEx($model),);
?><?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'View') . ' ' . $model->label() . ' ' . GxHtml::encode(GxHtml::valueEx($model)),
        'headerIcon' => 'icon-folder-open',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'size' => 'mini',
                'buttons' => array(
                    array(
                        'icon' => 'icon-edit',
                        'url' => array('update', 'id' => $model->id),
                        'htmlOptions' => array(
                            'rel' => 'tooltip',
                            'title' => Yii::t('app', 'Update {model}', array('{model}' => $model->label() . ' ' . GxHtml::encode(GxHtml::valueEx($model)))),
                        ),
                    ),
                ),
            ),
         )

));
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array('nbr',
//'serial',
'validFrom',
'validTo',
'name',
'rfc',
//'pem',
//'keyPem',
//'keyPassword',
'issuerName',
	),
));
?>
<?php $this->endWidget();?>
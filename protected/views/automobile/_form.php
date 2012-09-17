<div class="form">
<?php     /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id' => 'automobile-form',
	'enableAjaxValidation' => false,
        'htmlOptions'=>array('class'=>'well'),
        'type' => 'horizontal',
    ));
?>
<?php echo $form->errorSummary($model); ?>
<?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'pills', // 'tabs' or 'pills'
    'tabs'=>array(
        'Automobile' => array(
            'id' => 'Automobile',
            'label' => 'Automobile',
            'content' => $this->renderPartial('_formAutomobile',array("form"=>$form,"model"=>$model),true),
//            'view' => '_formAutomobile',
//            'data' => array('model' => $model, 'form' => $form),
            'active' => true
        ),
        'ExteriorColors' => array(
            'id' => 'ExteriorColors',
            'label' => 'Exterior Colors',
            'content' => $this->renderPartial('_formExteriorColors',array("form"=>$form,"model"=>$model),true),
        ),
        'Engine' => array(
            'id' => 'Engine',
            'label' => 'Engine',
            'content' => $this->renderPartial('_formEngine',array("form"=>$form,"model"=>$model),true),
//            'view' => '_formEngine',
//            'data' => array('model' => $model, 'form' => $form),
        ),
        'Drive' => array(
            'id' => 'Drive',
            'label' => 'Drive',
            'content' => $this->renderPartial('_formDrive',array("form"=>$form,"model"=>$model),true),
//            'view' => '_formDrive',
//            'data' => array('model' => $model, 'form' => $form),
        ),
        'Interior' => array(
            'id' => 'Interior',
            'label' => 'Interior',
            'content' => $this->renderPartial('_formInterior',array("form"=>$form,"model"=>$model),true),
//            'view' => '_formInterior',
//            'data' => array('model' => $model, 'form' => $form),
        ),
        'InteriorColors' => array(
            'id' => 'InteriorColors',
            'label' => 'Interior Colors',
            'content' => $this->renderPartial('_formInteriorColors',array("form"=>$form,"model"=>$model),true),
        ),
        'Dimensions' => array(
            'id' => 'Dimensions',
            'label' => 'Dimensions',
            'content' => $this->renderPartial('_formDimensions',array("form"=>$form,"model"=>$model),true),
//            'view' => '_formDimensions',
//            'data' => array('model' => $model, 'form' => $form),
        ),
    )
));?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    )); ?>
</div>

<?php $this->endWidget(); ?>
<!--<pre><?php if(isset($_POST) && $_POST!==array()) print_r($_POST);?></pre>-->
</div><!-- form -->
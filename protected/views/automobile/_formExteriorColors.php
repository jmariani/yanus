<fieldset>
    <div>
<?php
    $this->widget('ext.multiselects.XMultiSelects',array(
        'id' => 'exteriorColor',
        'leftTitle'=>'Available colors',
        'leftName'=>'exteriorColor[source][]',
        'leftList'=>GxHtml::listDataEx(($model->isNewRecord ?
            Color::model()->active()->findAllAttributes(null, true) :
            Color::model()->active()->notAvailableAsAutomobileExteriorColor($model->id)->findAllAttributes(null, true))),
        'rightTitle'=>'Exterior color',
        'rightName'=>'exteriorColor[target][]',
        'rightList'=>GxHtml::listDataEx(Color::model()->active()
                ->with(array('automobileAvailableColors' => array('scopes' => 'availableAsExteriorColor')))
                ->findAllAttributes(null, true, 'automobileAvailableColors.Automobile_id = :id', array(':id' => $model->id))),
        'size'=>20,
//        'width'=>'200px',
));
?>
    </div>
</fieldset>

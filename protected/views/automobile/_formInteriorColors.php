<fieldset>
    <div>
                <?php
                    $this->widget('ext.multiselects.XMultiSelects',array(
                        'id' => 'interiorColor',
                        'leftTitle'=>'Available colors',
                        'leftName'=>'interiorColor[source][]',
                        'leftList'=>GxHtml::listDataEx(($model->isNewRecord ?
                            Color::model()->active()->findAllAttributes(null, true) :
                            Color::model()->active()->notAvailableAsAutomobileInteriorColor($model->id)->findAllAttributes(null, true))),
                        'rightTitle'=>'Interior color',
                        'rightName'=>'interiorColor[target][]',
                        'rightList'=>GxHtml::listDataEx(Color::model()->active()
                                ->with(array('automobileAvailableColors' => array('scopes' => 'availableAsInteriorColor')))
                                ->findAllAttributes(null, true, 'automobileAvailableColors.Automobile_id = :id', array(':id' => $model->id))),
                        'size'=>20,
                //        'width'=>'200px',
                ));
                ?>
    </div>
</fieldset>

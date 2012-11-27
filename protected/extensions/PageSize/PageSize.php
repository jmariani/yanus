<?php

/**
 * Simple widjet for selecting page size of gridviews
 *
 * @author	Aruna Attanayake <aruna470@gmail.com>
 * @version 1.0
 */
class PageSize extends CWidget {

    public $mPageSizeOptions = array(10 => 10, 25 => 25, 50 => 50, 75 => 75, 100 => 100);
    public $mPageSize = 10;
    public $mGridId = '';
    public $mDefPageSize = 10;
    public $label = 'Items per page';
    public $htmlOptions;

    public function run() {
        Yii::app()->user->setState('pageSize', $this->mPageSize);

        $this->mPageSize = null == $this->mPageSize ? $this->mDefPageSize : $this->mPageSize;

//        echo $this->label . ': ';
        $htmlOptions = array(
            'onchange' => "$.fn.yiiGridView.update('$this->mGridId',{ data:{pageSize: $(this).val() }})",
            'style' => 'width: 60px',
        );
        echo $this->label . ': ';
//        $this->widget('bootstrap.widgets.TbButtonGroup', array(
//            'buttons' => array(
//                array('label' => '10', 'url' => '#'),
//                array('label' => '25', 'url' => '#'),
//                array('label' => '50', 'url' => '#'),
//                array('label' => '75', 'url' => '#'),
//                array('label' => '100', 'url' => '#')
//            ),
//        ));
//        echo GxHtml::label($this->label . ': ', 'pageSize', array('display' => 'inline'));
        if ($this->htmlOptions)
            $htmlOptions = array_merge($htmlOptions, $this->htmlOptions);
        echo GxHtml::dropDownList('pageSize', $this->mPageSize, $this->mPageSizeOptions, $htmlOptions);
    }

}

?>
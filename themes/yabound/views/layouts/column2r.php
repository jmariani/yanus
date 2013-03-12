<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
    <div class="span9">

    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Home'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <!-- Include content pages -->
    <?php echo $content; ?>

    </div><!--/span-->
    <div class="span3">
        <div class="sidebar-nav">
		  <?php
                    $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
                            array('label'=>'FAVORITES','items'=>array(
				array('label'=>'<i class="icon icon-list"></i> ' . IncomingInvoiceInterfaceFile::label(2) . ' <span class="badge badge-success pull-right">' . IncomingInvoiceInterfaceFile::model()->count() . '</span>',
                                    'url'=>array("/incominginvoiceinterfacefile"),'itemOptions'=>array('class'=>'')),
				array('label'=>'<i class="icon icon-search"></i> About this theme <span class="label label-important pull-right">HOT</span>', 'url'=>'http://www.webapplicationthemes.com/abound-yii-framework-theme/'),
				array('label'=>'<i class="icon icon-envelope"></i> Messages <span class="badge badge-success pull-right">12</span>', 'url'=>'#'),
                            ),
			),
			)));?>

        <?php
//        $this->widget('bootstrap.widgets.TbBox', array(
//            'title' => 'Favorites',
//            'headerIcon' => 'icon-home',
//            'content' => $this->widget('bootstrap.widgets.TbMenu', array(
//                    'type'=>'list',
//                    'items' => array(
//                        array('label'=> yii::t('app', 'Manage' . ' ' . IncomingInvoiceInterfaceFile::label(2)), 'url'=>Yii::app()->baseUrl . "/incomingInvoiceInterfaceFile", 'icon' => 'icon-list'),
//                    )
//                ), true),
////
////            'content' => $this->widget('zii.widgets.CMenu', array(
////            /*'type'=>'list',*/
////            'encodeLabel'=>false,
////
////            'items' => array(
////                array('label'=> yii::t('app', 'Manage' . ' ' . IncomingInvoiceInterfaceFile::label(2)), 'url'=>Yii::app()->baseUrl . "/incomingInvoiceInterfaceFile", 'icon' => 'icon-list'),
////            )
////,
////            ), true)
//        ));
        ?>
<br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiAccordion', array(
            'panels'=>array(
//                'panel 1'=>'content for panel 1',
//                'Billing'=> $this->widget('bootstrap.widgets.TbMenu', array(
//                    'type'=>'list',
//                    'items' => array(
////                        array('label'=>'List header', 'itemOptions'=>array('class'=>'nav-header')),
//                        array('label'=> yii::t('app', 'Manage' . ' ' . Country::label(2)), 'url'=>Yii::app()->baseUrl . "/country", 'icon' => 'icon-list'),
//                        array('label'=> yii::t('app', 'Manage' . ' ' . Currency::label(2)), 'url'=>Yii::app()->baseUrl . "/currency", 'icon' => 'icon-list'),
//                        array('label'=> yii::t('app', 'Manage' . ' ' . State::label(2)), 'url'=>Yii::app()->baseUrl . "/state", 'icon' => 'icon-list'),
////                        '',
////                        array('label'=>'Help', 'url'=>'#'),
//                    )
//                ), true),
                'Parties'=> $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'list',
                    'encodeLabel' => true,
                    'items' => array(
//                        array('label'=>'List header', 'itemOptions'=>array('class'=>'nav-header')),
                        array('label'=> yii::t('app', 'Manage' . ' ' . PartyMail::label(2)) . ' <span class="badge badge-success pull-right">' . PartyMail::model()->count() . '</span>', 'url'=>Yii::app()->baseUrl . "/partyMail",
                            'icon' => 'icon-list'),
//                        '',
//                        array('label'=>'Help', 'url'=>'#'),
                    )
                ), true),
                'Settings'=> $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'list',
                    'items' => array(
//                        array('label'=>'List header', 'itemOptions'=>array('class'=>'nav-header')),
                        array('label'=> yii::t('app', 'Manage' . ' ' . Country::label(2)), 'url'=>Yii::app()->baseUrl . "/country", 'icon' => 'icon-list'),
                        array('label'=> yii::t('app', 'Manage' . ' ' . Currency::label(2)), 'url'=>Yii::app()->baseUrl . "/currency", 'icon' => 'icon-list'),
                        array('label'=> yii::t('app', 'Manage' . ' ' . State::label(2)), 'url'=>Yii::app()->baseUrl . "/state", 'icon' => 'icon-list'),
//                        '',
//                        array('label'=>'Help', 'url'=>'#'),
                    )
                ), true),
                    // panel 3 contains the content rendered by a partial view
                    // 'panel 3'=>$this->renderPartial('_partial',null,true),
            ),
            // additional javascript options for the accordion plugin
            'options'=>array(
                'animated'=>'bounceslide',
                'collapsible' => 'true',
                'heightStyle' => 'fill'
            ),
        ));
        ?>
        <br/>
        <?php
        if ($this->menu)
        $this->widget('bootstrap.widgets.TbBox', array(
            'title' => 'Operations',
            'headerIcon' => 'icon-home',
            'content' =>         $this->widget('zii.widgets.CMenu', array(
            /*'type'=>'list',*/
            'encodeLabel'=>false,
            'items'=>$this->menu,
            ), true)
        ));
        ?>
        </div>

<!--
        <br>
        <table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <td width="50%">Bandwith Usage</td>
              <td>
              	<div class="progress progress-danger">
                  <div class="bar" style="width: 80%"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Disk Spage</td>
              <td>
             	<div class="progress progress-warning">
                  <div class="bar" style="width: 60%"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Conversion Rate</td>
              <td>
             	<div class="progress progress-success">
                  <div class="bar" style="width: 40%"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Closed Sales</td>
              <td>
              	<div class="progress progress-info">
                  <div class="bar" style="width: 20%"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
		<div class="well">

            <dl class="dl-horizontal">
              <dt>Account status</dt>
              <dd>$1,234,002</dd>
              <dt>Open Invoices</dt>
              <dd>$245,000</dd>
              <dt>Overdue Invoices</dt>
              <dd>$20,023</dd>
              <dt>Converted Quotes</dt>
              <dd>$560,000</dd>

            </dl>
      </div>
-->
    </div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>
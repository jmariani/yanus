<?php
class AdSenseWidget extends CWidget
{

   public $clientId;
   public $channelId;

   public function run()
   {

      // output the AdSense code here
      // like...
    $js='';

    $js .= 'google_ad_client="pub-4755521732127219";';
    $js .= 'google_ad_host="pub-1556223355139109";';
    $js .= 'google_ad_width=300;';
    $js .= 'google_ad_height=250;';
    $js .= 'google_ad_format="300x250_as";';
    $js .= 'google_ad_type="text_image";';
    $js .= 'google_ad_host_channel="0001+S0009+L0003";';
    $js .= 'google_color_border="000000";';
    $js .= 'google_color_bg="000000";';
    $js .= 'google_color_link="CCCCCC";';
    $js .= 'google_color_url="99AADD";';
    $js .= 'google_color_text="777777";';

//--></script>
//<script type="text/javascript"
//  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
//</script>

    Yii::app()->clientScript->registerScript(get_class($this) . '_options', $js, CClientScript::POS_END);
   }

}?>

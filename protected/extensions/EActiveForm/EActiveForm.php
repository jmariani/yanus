<?php
/**
 * Vencidi Active Form Widget
 *
 * PHP Version 5.1
 *
 * @category Vencidi
 * @package  Widget
 * @author   Loren <wiseloren@yiiframework.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://www.vencidi.com/ Vencidi
 * @since    3.0
 */
/**
 * Vencidi Active Form Widget
 *
 * PHP Version 5.1
 *
 * Creates an Active Form which will warn if the user makes changes but doesn't save.
 * Also, enables client side validation which will not submit if their are errors.
 * 
 * @category Vencidi
 * @package  Widget
 * @author   Loren <wiseloren@yiiframework.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @version  Release: 1.0.1
 * @link     http://www.vencidi.com/ Vencidi
 * @since    3.0
 */
class EActiveForm extends CActiveForm
{
    public $clientOptions = array(
        'validateOnSubmit' => true,
        'afterValidate' => '', // Set in init
    );
    public $enableClientValidation=true;

    /**
    * Initializes the widget, javascript, and calls the parent init function
    *
    * @return void
    */
    function init()
    {
        // Allow submit without an annoying popup confirm
        $this->clientOptions['afterValidate'] = 'js:function(form, data, hasError)'.
            ' { if (hasError == false) { changed=false; } return true; }';
        $this->clientOptions['validateOnSubmit'] = true;
        //$this->clientOptions['beforeValidateAttribute'] = 'js:'.
        //    'function(form, attribute) { changed=true; return true; }';
        $js = 'var changed=false;'."\n".
            'function goodbye(e) { '."\n".
           '    if (changed) {'."\n".
           '        if(!e) e = window.event;'."\n".
                   // e.cancelBubble is supported by IE - this will kill the
                   // bubbling process.
           '        e.cancelBubble = true;'."\n".
           '        e.returnValue = \'You will lose changes if you leave this '.
           'page, please press Cancel to stay on this page and save your '.
           'changes.\'; '."\n".
                   //This is displayed on the dialog

                   //e.stopPropagation works in Firefox, but breaks IE.
                   // It works in at least FF 3.6+ without this
//           '        if (e.stopPropagation) {'."\n".
//           '          e.stopPropagation();'."\n".
//           '          e.preventDefault();'."\n".
//           '        } return "hey"; '."\n".
           '        return "You will lose changes if you leave this '.
           'page, please press Cancel to stay on this page and save your '.
           'changes.";'."\n".
           '    }'."\n".
           '}'."\n".
           '$(window).bind(\'beforeunload\', goodbye);'."\n".
        '$( function () { $("#'.$this->id.'").find("input, select, textarea").'.
            'keydown( function() { changed=true; }).'.
            'change( function() { changed=true; }); });';
        Yii::app()->clientScript->registerScript(
            'JValidatechanged',
            $js,
            CClientScript::POS_END
        );
        parent::init();
    }
}
?>

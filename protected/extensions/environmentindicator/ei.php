<?php

/**
 * Environment Indicator
 * by imehesz
 * imehesz [at] gmail.com
 */
class ei extends CWidget {

    public $color = '#006400';
    public $text = 'ENVIRONMENT INDICATOR';
    public $position = 'left';
    public $top = '100px';
    public $width = '20px';

    public function init() {
        $cs = Yii::app()->getClientScript();
        $css = <<<CSS
.eindicator
{
        top:{$this->top};
	height:100%;
	text-align:center;
	color:#fff;
	font-size: 1.3em;
        width:{$this->width};
	background-color: {$this->color}
}

.ei-left
{
	position:fixed;
	left:0;
	padding:3px;
}

.ei-right
{
	position: fixed;
	right: 0;
	padding: 3px;
}
CSS;
        $cs->registerCss('ei-css', $css);
        parent::init();
    }

    public function run() {
        echo '<div id="ei" class="ei-' . $this->position . ' eindicator">' . $this->_turn90($this->text) . '</div>';
    }

    private function _turn90($str) {
        $retval = '';

        for ($i = 0; $i < strlen($str); $i++) {
            $char = substr($str, $i, 1);
            $retval .= $char . '<br />';
        }
        return $retval;
    }

}

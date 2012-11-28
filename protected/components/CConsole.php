<?php
/**
 * CConsole class
 *
 * PHP version 5
 *
 * @category Components
 * @package  Ext.console
 * @author   Evgeniy Marilev <jeka@5-soft.com>
 */
/**
 * CConsole is the class for working with system shell
 * and yii console
 *
 * @category Components
 * @package  Ext.console
 * @author   Evgeniy Marilev <jeka@5-soft.com>
 */
class CConsole extends CComponent
{
    const RUN_SYNC = false;
    const RUN_ASYNC = true;

    /**
     * Path to application's commands script
     * @var string
     */
    public $commandsPath = 'application.yiic';

    /**
     * Constructs console object
     *
     * @return void
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initializes console
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Executes shell command
     *
     * @param mixed $shell          shell command with params or shell array (array(command, arg1, arg2, ...))
     * @param bool  $async          whether required to run shell command asynchronous
     * @param mixed $redirectOutput file to redirect output or array with files to redirect output
     *
     * @return array output line
     */
    public function exec($shell, $async = false, $redirectOutput = '')
    {
        if (is_array($shell)) {
            $command = $shell[0];
            unset($shell[0]);
            foreach ($shell as $param => $value) {
                if (is_string($param)) {
                    $command .= ' ' . $param;
                }
                $command .= ' ' . $value;
            }
        }

        if ($async) {
            $asyncOutputs = array('/dev/null', '&1');
            $redirectOutput = is_array($redirectOutput) ? $redirectOutput : (!empty($redirectOutput) ? array($redirectOutput) : array());
            $redirectOutput = array_merge($asyncOutputs, $redirectOutput);
        }

        if (is_array($redirectOutput)) {
            foreach ($redirectOutput as $i => $file) {
                $command .= ' ';
                if ($i > 0) {
                    $command .= ($i + 1);
                }
                $command .= '>' . $file;
            }
        }

        $command .= $async ? ' &' : '';
        $ret = '';

        yii::trace('Running command "' . $command . '"', __METHOD__);

        exec($command, $ret);
        return $ret;
    }

    /**
     * Runs console command
     *
     * @param string $command console command name
     * @param array  $args    command arguments array
     * @param bool   $async   whether required to run console command asynchronous
     *
     * @return array output line
     */
    public function runCommand($command, $args, $async = false, $redirectOutput = '')
    {
        $pathToYiic = $this->getYiiConsolePath();
        $shell = array(
            $pathToYiic,
            $command,
        );
        $shell = CMap::mergeArray($shell, $args);
        return $this->exec($shell, $async, $redirectOutput);
    }

    /**
     * Returns path to application's yii console
     *
     * @return string path to yii console
     */
    protected function getYiiConsolePath()
    {
        return Yii::getPathOfAlias($this->commandsPath);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-19
 * Time: 下午9:18
 */

namespace Core;


class Logger
{
    const LOGGER_OUTPUT_FILENAME = "D:/Deline/Logger.txt";
    const LOGGER_ERROUT_FILENAME = "D:/Deline/Error.txt";

    private $output;
    private $errout;

    public function __construct()
    {
        $this->output = fopen(self::LOGGER_OUTPUT_FILENAME, "rw");
        $this->errout = fopen(self::LOGGER_ERROUT_FILENAME, "rw");
    }

    public function log($tag,$msg) {

    }

    public function err($tag, $msg, $filename, $line_number) {

    }

    public function __destruct()
    {
        fclose($this->output);
        fclose($this->errout);
    }
}
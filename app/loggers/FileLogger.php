<?php

namespace App\loggers;

class FileLogger extends AbstractLogger
{
    protected $file;
    protected $path = 'logs/app.log';

    public function __construct($path = null)
    {
        if (null !== $path) {
            $this->path = $path;
        }

        $this->file = fopen(APP_DIR . $this->path, 'a');
    }

    public function __destruct()
    {
        @fclose($this->file);
    }

    public function log($msg)
    {
        if (empty($msg) || empty($this->file)) {
            return ;
        }

        $msg =  date('Y-m-d H:i:s') . ': ' . $msg;

        $msg = str_replace("\n", '', $msg) . "\n";

        fwrite($this->file, $msg);
    }
}

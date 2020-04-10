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

        $this->file = fopen($this->path, 'a');
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

        $msg =  date('Y-m-d H:i:s') . ' : ' . $msg;

        // check eol on message end
        if (stripos(strrev($msg), "\n") !== 0) {
            $msg .= "\n";
        }

        fwrite($this->file, $msg);
    }
}

<?php

namespace App\loggers;

use App\Mailer;

class EmailLogger extends AbstractLogger
{
    protected $mailer;
    protected $recepients = [
        'logger@test.com',
    ];

    public function __construct($recepients = [])
    {
        if (!empty($recepients) && is_array($recepients)) {
            $this->recepients = array_merge($this->recepients, $recepients);
        }

        $this->mailer = new Mailer();
    }

    public function log($msg)
    {
        if (empty($msg) || empty($this->recepients)) {
            return ;
        }

        $this->mailer->send($this->recepients, 'Vehicle logger', $msg);
    }
}

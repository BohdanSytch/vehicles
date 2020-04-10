<?php

namespace App;

class Mailer
{
    public function __construct()
    {
        // server params from config
    }

    public function send($recepients, $subject, $body)
    {
        if (!is_array($recepients)) {
            $recepients = [$recepients];
        }

        echo "Sending ... (";
        echo 'recepients:' . join($recepients, ',');
        echo ' subject:' . $subject;
        echo ' body:' . $body;
        echo ")\n";
    }
}

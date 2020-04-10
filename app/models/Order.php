<?php

namespace App\models;

use Exception;
use Datetime;
use App\Models\User as User;
use App\Models\Customer as Customer;
use App\Models\Manager as Manager;
use App\Models\Vehicle as Vehicle;
use App\loggers\EmailLogger as EmailLogger;
use App\loggers\FileLogger as FileLogger;
use App\Mailer as Mailer;

class Order
{
    public const ORDER_STATUS_NEW         = 'new';
    public const ORDER_STATUS_IN_PROGRESS = 'in_progress';
    public const ORDER_STATUS_DONE        = 'done';
    public const ORDER_STATUS_FAILED      = 'failed';

    public static $statuses = [
        self::ORDER_STATUS_NEW         => 'New',
        self::ORDER_STATUS_IN_PROGRESS => 'In progress',
        self::ORDER_STATUS_DONE        => 'Done',
        self::ORDER_STATUS_FAILED      => 'Failed',
    ];

    protected $id;
    protected $customer;
    protected $vehicle;
    protected $manager;
    protected $status = self::ORDER_STATUS_NEW;

    protected $checkpoints = [];

    protected $created_at;
    protected $updated_at;

    public $file_logging  = true;
    public $email_logging = true;

    public function __construct(Manager $manager, Customer $customer, Vehicle $vehicle)
    {
        if (!$vehicle->isValid()) {
            throw new Exception('Vehicle not ready for assembly process');
        }

        $this->id = uniqid();
        $this->manager = $manager;
        $this->customer = $customer;
        $this->vehicle = $vehicle;
        $this->created_at = new Datetime();

        $this->addCheckpoint('', $manager, $this->status);
    }

    public function addCheckpoint($description, User $user, $status = null)
    {
        if (null !== $status && $this->status != $status) {
            $this->setStatus($status);
        }

        $checkpoint = [
            'user'        => $user,
            'status'      => $this->status,
            'description' => $description,
            'created_at'  => new Datetime(),
        ];
        $this->checkpoints[] = $checkpoint;

        $this->updated_at = new Datetime();

        if ($this->file_logging) {
            // save to log
            (new FileLogger())->log(
                ' Order #' . $this->getId()
                . ' Status: ' . $this->getStatusTitle($checkpoint['status'])
                . ' User: ' . $checkpoint['user']->getEmail()
                . ' Description: ' . $checkpoint['description']
                . ' Date: ' . $checkpoint['created_at']->format("Y-m-d H:i:s")
            );
        }

        if ($this->email_logging) {
            // send email
            (new EmailLogger())->log(
                ' Order #' . $this->getId()
                . ' Status: ' . $this->getStatusTitle($checkpoint['status'])
                . ' User: ' . $checkpoint['user']->getEmail()
                . ' Description: ' . $checkpoint['description']
                . ' Date: ' . $checkpoint['created_at']->format("Y-m-d H:i:s")
            );
        }

        if (self::ORDER_STATUS_DONE == $this->status) {
            // send email to customer
            $emailTo = $this->customer->getEmail();
            $emailSubject = 'Your order is succefully done!';
            $emailBody =
                'Vehicle ('
                    . $this->vehicle->getType()
                    . ' '
                    . $this->vehicle->getcolor()
                . ') ready to go!';

            (new Mailer())->send($emailTo, $emailSubject, $emailBody);
        }
    }

    public function checkpointsToString()
    {
        $checkpointsStr = '';
        $ind = 0;
        foreach ($this->checkpoints as $checkpoint) {
            $checkpointsStr .=
                ' #' . ++$ind
                . ' Status: ' . $this->getStatusTitle($checkpoint['status'])
                . ' User: ' . $checkpoint['user']->getEmail()
                . ' Description: ' . $checkpoint['description']
                . ' Date: ' . $checkpoint['created_at']->format("Y-m-d H:i:s")
                . "\n";
        }
        if (!empty($checkpointsStr)) {
            $checkpointsStr = "Checkpoints: \n" . $checkpointsStr;
        }
        return $checkpointsStr;
    }

    public function setStatus($status)
    {
        if (!$this->isStatusValid($status)) {
            throw new Exception('Incorect order status "' . $status . '"');
        }

        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusTitle($status = null)
    {

        return static::$statuses[null !== $status ? $status : $this->status];
    }

    public function isStatusValid($status)
    {
        return in_array($status, $this->getAllStatuses());
    }

    protected function getAllStatuses()
    {
        return array_keys(static::$statuses);
    }

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return
            "Order #" . $this->getId() . "\n"
            . "Status: " . $this->getStatusTitle() . "\n"
            . "Created at: " . $this->created_at->format("Y-m-d H:i:s") . "\n"
            . "Updated at: " . $this->created_at->format("Y-m-d H:i:s") . "\n"
            . $this->customer
            . $this->manager
            . $this->vehicle
            . $this->checkpointsToString();
    }
}

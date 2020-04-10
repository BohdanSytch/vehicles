<?php

require_once __DIR__ . '/../header.php';

use Exception;

use App\Models\User as User;
use App\Models\Customer as Customer;
use App\Models\Manager as Manager;

use App\Models\Engine as Engine;
use App\Models\Transmission as Transmission;
use App\Models\Car as Car;
use App\Models\Truck as Truck;

use App\Models\Order as Order;


echo '<span style="white-space: pre-line">';

try {
    $user1 = new User('user1@test.com');
    // echo $user1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}

try {
    $user2 = new User('user2@test.com');
    // echo $user1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}


try {
    $customer1 = new Customer('customer1@test.com');
    // echo "\n----------\n";
    // echo $customer1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}


try {
    $manager1 = new Manager('manager1@test.com');
    // echo "\n----------\n";
    // echo $manager1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}


try {
    $user1 = new User('user1@test.com');
    // echo "\n----------\n";
    // echo $user1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}

// Truck
try {
    $engine = new Engine(Engine::TYPE_2STROKE, 1.2);
    // echo "\n----------\n";
    // echo $engine;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    die;
}

try {
    $transmission = new Transmission(Transmission::TYPE_MANUAL, 4);
    // echo "\n----------\n";
    // echo $transmission;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}

try {
    $vehicle1 = new Truck();
    $vehicle1->setTransmission($transmission);
    $vehicle1->setEngine($engine);
    $vehicle1->setColor('blue');
    $vehicle1->addOption('option1');
    // echo "\n----------\n";
    // echo $vehicle1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}

try {
    echo "\n----------\n";
    $order1 = new Order($manager1, $customer1, $vehicle1);
    echo $order1;

    $order1->addCheckpoint('start', $user1, Order::ORDER_STATUS_IN_PROGRESS);
    echo "\n----------\n";
    echo $order1;

    $order1->addCheckpoint('done', $user2, Order::ORDER_STATUS_DONE);
    echo "\n----------\n";
    echo $order1;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}

// Car
try {
    $vehicle2 = new Car();
    $vehicle2->setTransmission(new Transmission(Transmission::TYPE_AUTOMATIC, 4));
    $vehicle2->setEngine(new Engine(Engine::TYPE_6STROKE, 2.6));
    $vehicle2->setColor('red');

    echo "\n----------\n";
    $order2 = new Order($manager1, $customer1, $vehicle2);
    echo $order1;

    $order2->addCheckpoint('start', $user1, Order::ORDER_STATUS_IN_PROGRESS);
    echo "\n----------\n";
    echo $order2;

    $order2->addCheckpoint('done', $user2, Order::ORDER_STATUS_DONE);
    echo "\n----------\n";
    echo $order2;
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}

echo "\nDone";

echo '</span>';

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
use App\Actions\CarAssemblyProcessPaintOperation as CarPaintOperation;
use App\Actions\TruckAssemblyProcessPaintOperation as TruckPaintOperation;
use App\Actions\VehicleAssemblyProcessMountEngineOperation as MountEgnineOperation;


echo '<span style="white-space: pre-line">';

// Users
try {
    $user1 = new User('user1@test.com');
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}

try {
    $user2 = new User('user2@test.com');
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}

try {
    $customer1 = new Customer('customer1@test.com');
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}

try {
    $manager1 = new Manager('manager1@test.com');
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}

try {
    $user1 = new User('user1@test.com');
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}
// /Users

// Truck
try {
    $engine = new Engine(Engine::TYPE_4STROKE, 1.2);
    // echo "\n----------\n";
    // echo $engine;
    // echo "\n----------\n";
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}

try {
    $transmission = new Transmission(Transmission::TYPE_MANUAL, 4);
    // echo "\n----------\n";
    // echo $transmission;
    // echo "\n----------\n";
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
    exit(1);
}

try {
    $vehicle1 = new Truck();
    $vehicle1->setTransmission($transmission);
    $vehicle1->setEngine($engine);
    $vehicle1->setColor('blue');
    $vehicle1->addOption('option1');
    // echo "\n----------\n";
    // echo $vehicle1;
    // echo "\n----------\n";

    $order1 = new Order($manager1, $customer1, $vehicle1);
    echo "\n----------\n";
    echo $order1;
    echo "\n----------\n";

    $order1->addCheckpoint('start', $user1, Order::ORDER_STATUS_IN_PROGRESS);
    echo "\n----------\n";
    echo $order1;
    echo "\n----------\n";

    $paintOperation = new TruckPaintOperation();
    if ($paintOperation->perform()) {
        $order1->addCheckpoint((string) $paintOperation, $user2);
        echo "\n----------\n";
        echo $order1;
        echo "\n----------\n";
    }

    $mountEgnineOperation = new MountEgnineOperation();
    if ($mountEgnineOperation->perform()) {
        $order1->addCheckpoint((string) $mountEgnineOperation, $user1);
        echo "\n----------\n";
        echo $order1;
        echo "\n----------\n";
    }

    $order1->addCheckpoint('done', $user2, Order::ORDER_STATUS_DONE);
    echo "\n----------\n";
    echo $order1;
    echo "\n----------\n";
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}
// /Truck


// Car
try {
    $vehicle2 = new Car();
    $vehicle2->setTransmission(new Transmission(Transmission::TYPE_AUTOMATIC, 4));
    $vehicle2->setEngine(new Engine(Engine::TYPE_6STROKE, 2.6));
    $vehicle2->setColor('red');


    $order2 = new Order($manager1, $customer1, $vehicle2);
    $order2->email_logging = false; // email logging is disabled for this order
    echo "\n----------\n";
    echo $order2;
    echo "\n----------\n";

    $order2->addCheckpoint('start', $user1, Order::ORDER_STATUS_IN_PROGRESS);
    echo "\n----------\n";
    echo $order2;
    echo "\n----------\n";

    $paintOperation = new CarPaintOperation();
    if ($paintOperation->perform()) {
        $order2->addCheckpoint((string) $paintOperation, $user2);
        echo "\n----------\n";
        echo $order2;
        echo "\n----------\n";
    }

    $mountEgnineOperation = new MountEgnineOperation();
    if ($mountEgnineOperation->perform()) {
        $order2->addCheckpoint((string) $mountEgnineOperation, $user1);
        echo "\n----------\n";
        echo $order2;
        echo "\n----------\n";
    }

    $order2->addCheckpoint('done', $user2, Order::ORDER_STATUS_DONE);
    echo "\n----------\n";
    echo $order2;
    echo "\n----------\n";
} catch (Exception $e) {
    echo 'Error ' . $e->getMessage() . "\n";
}
// /Car


echo "\nDone";

echo '</span>';

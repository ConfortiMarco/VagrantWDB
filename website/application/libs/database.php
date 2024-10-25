<?php
use Illuminate\Database\Capsule\Manager as Capsule;
class Database {
    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => MYSQLI_HOST,
            'database' => MYSQLI_DB,
            'username' => MYSQLI_USERNAME,
            'password' => MYSQLI_PASS,
     ]);
     $capsule->bootEloquent();
     }
}
?>
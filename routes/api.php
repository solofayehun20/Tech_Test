
<?php


use App\Http\Controllers\VehicleController;

Route::get('/vehicles', [VehicleController::class, 'search']);
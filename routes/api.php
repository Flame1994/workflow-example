<?php
use Illuminate\Support\Facades\Route;

Route::resources(
    [
        'companies' => 'CompanyController',
        'clients' => 'ClientController',
    ]
);

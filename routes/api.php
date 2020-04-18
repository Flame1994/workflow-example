<?php
use Illuminate\Support\Facades\Route;

Route::post('companies', 'CompanyController@create');
Route::get('companies/{id}', 'CompanyController@read');
Route::post('companies/{id}', 'CompanyController@update');
Route::delete('companies/{id}', 'CompanyController@delete');
Route::get('companies', 'CompanyController@list');

Route::post('clients', 'ClientController@create');
Route::get('clients/{id}', 'ClientController@read');
Route::post('clients/{id}', 'ClientController@update');
Route::delete('clients/{id}', 'ClientController@delete');
Route::get('clients', 'ClientController@list');

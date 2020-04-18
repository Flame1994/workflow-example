<?php
use Illuminate\Support\Facades\Route;

Route::post('companies', 'CompanyController@create');
Route::get('companies/{id}', 'CompanyController@read');
Route::put('companies/{id}', 'CompanyController@update');
Route::delete('companies/{id}', 'CompanyController@delete');
Route::get('companies', 'CompanyController@list');

Route::post('companies/{company_id}/clients', 'ClientController@create');
Route::get('companies/{company_id}/clients/{id}', 'ClientController@read');
Route::put('companies/{company_id}/clients/{id}', 'ClientController@update');
Route::delete('companies/{company_id}/clients/{id}', 'ClientController@delete');
Route::get('companies/{company_id}/clients', 'ClientController@list');

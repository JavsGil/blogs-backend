<?php
Route::namespace('Usuarios')->prefix('usuarios')->middleware('auth.jwt')->group(function () {

    Route::get('listar/{id}', 'UsuariosController@ListarUsuariosId');

});

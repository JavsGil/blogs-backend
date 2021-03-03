<?php

namespace App\Repositories;

use App\User;

class UsuarioRepository extends BaseRepository
{
    public function getFieldsSearchable()
    {
        return [];
    }

    public function model(){
        return User::class;
    }

    public function encontrar($id)
    {
        return User::find($id);
    }
}
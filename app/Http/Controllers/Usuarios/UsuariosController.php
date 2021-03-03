<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\AppBaseController;
use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;


class UsuariosController extends AppBaseController
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->UsuarioRepository = $usuarioRepository;
    }

    public function ListarUsuariosId($id)
    {
        try {
            $data = $this->UsuarioRepository->encontrar($id);
            return $this->sendResponse($data, 'show Cliente');

        } catch (\Throwable $e) {
            return $this->sendError($e);
        }
    }
}

<?php

namespace App\Controllers;

class Cadastro extends BaseController {
    public function cadastro() {
        $municipioId = $this->request->getPost('municipio');
        $estadoId = $this->request->getPost('estado');

        d([
            'municipio' => $municipioId,
            'estado' => $estadoId
        ]);
    }
}
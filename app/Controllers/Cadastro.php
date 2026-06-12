<?php

namespace App\Controllers;
use App\Models\EstadoModel;
use App\Models\MunicipioModel;

class Cadastro extends BaseController
{
    public function cadastro()
    {
        $nome = $this->request->getPost('nome');
        $cpf = $this->request->getPost('cpf');
        $estadoId = $this->request->getPost('estado');
        $municipioId = $this->request->getPost('municipio');
        


        $data = [
            'nome' => $nome,
            'cpf' => $cpf,
            'estado_id' => $estadoId,
            'municipio_id' => $municipioId,
        ];

         $clienteService = service('cliente');
        // Lógica para criar o cliente com os dados fornecidos
        $r = $clienteService->createCliente($data);
        if ($r['status'] === 'error') {
            return $r['message'];
        }
        else {
            return redirect()->back()->with('message', $r['message']);
        }
        
    }
}
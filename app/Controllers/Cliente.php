<?php

namespace App\Controllers;
use App\Models\MunicipioModel;
use App\Models\EstadoModel;
use App\Models\ClienteModel;


class Cliente extends BaseController
{

    public function index(): string
    {

        $clienteService = service('cliente');

        $r = $clienteService->getClientes();

        $this->EstadoModel = new EstadoModel();
        $estado = $this->EstadoModel->find($r['data'][0]['estado_id']);
        $this->MunicipioModel = new MunicipioModel();
        $municipio = $this->MunicipioModel->find($r['data'][0]['municipio_id']);

        foreach ($r['data'] as $index => $cliente) {
            $estado = $this->EstadoModel->find($cliente['estado_id']);
            $municipio = $this->MunicipioModel->find($cliente['municipio_id']);

            $r['data'][$index]['estado_id'] = $estado['nome'];
            $r['data'][$index]['municipio_id'] = $municipio['nome'];
        }
        

        if ($r['status'] === 'error') {
            return $r['message'];
        }

        return view('clientes', [
            'clientes' => $r['data'],
            'pager' => $r['pager']
        ]);
    }

    public function delete($id)
    {
        $clienteService = service('cliente');
        // Lógica para excluir o cliente com o ID fornecido
        $r = $clienteService->deleteCliente($id);

        if ($r['status'] === 'error') {
            return $r['message'];
        }

        return redirect()->back()->with('message', $r['message']);
    }

    public function edit($id)
    {
        // Lógica para exibir o formulário de edição do cliente com o ID fornecido
        return view('index', [
            'user' => $this->ClienteModel->find($id)
        ]);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClienteService;
use App\Services\EstadoService;
use App\Services\MunicipioService;
use CodeIgniter\HTTP\ResponseInterface;

class ClienteController extends BaseController {

    protected ClienteService $clienteService;
    protected EstadoService $estadoService;
    protected MunicipioService $municipioService;

    public function __construct() {
        $this->clienteService = service('cliente');
        $this->estadoService = service('estado');
        $this->municipioService = service('municipio');
    }

    public function create() {
        $estados = $this->estadoService->getAllEstados();

        if ($estados['status'] === 'error') {
            return redirect()->back()->with('error', $estados['message']);
        }

        $municipios = [];
        $estadoOld = old('estado_id');

        if ($estadoOld) {
            $result = $this->municipioService->getMunicipiosByEstado($estadoOld);
            if($result['status'] === 'success') {
                $municipios = $result['data'];
            }
        }

        return view('cadastro', [
            'estados' => $estados['data'],
            'municipios' => $municipios
        ]);
    }

    public function store() {
        $clienteData = $this->clienteService->createCliente([
            'nome' => $this->request->getPost('nome'),
            'cpf' => $this->request->getPost('cpf'),
            'estado_id' => $this->request->getPost('estado_id'),
            'municipio_id' => $this->request->getPost('municipio_id')
        ]);

        if ($clienteData['status'] === 'error') {
            return redirect()->route('cadastro')
                ->withInput()
                ->with('error', $clienteData['message'])
                ->with('validationErrors', $clienteData['errors'] ?? []); // corrigido typo
        }

        return redirect()->route('cadastro')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function read() {
        $clientes = $this->clienteService->getAllClientes();

        if ($clientes['status'] === 'error') {
            return redirect()->route('clientes')->with('error', $clientes['message']);
        }

        return view('clientes', [
            'clientes' => $clientes['data'],
            'pager' => $clientes['pager']
        ]);
    }

    public function edit($id) {
        //
    }

    public function update($id) {
        //
    }

    public function delete(int $id) {

    }
}

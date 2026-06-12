<?php

namespace App\Controllers;

class Cliente extends BaseController
{
    
    public function index(): string
    {
        $clienteService = service('cliente');

        $r = $clienteService->getClientes();


        if ($r['status'] === 'error') {
            return $r['message'];
        }

        $clientes = $r['data'];


        return view('clientes', [
            'clientes' => $clientes,
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
}

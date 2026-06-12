<?php

namespace App\Services;

use App\Models\ClienteModel;

class ClienteService
{
    protected $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
    }

    public function getClientes()
    {
        /*
            Retorna a lista de clientes.
        */

        try {

            $clientes = $this->clienteModel->paginate(5);
            $pager = $this->clienteModel->pager;
           

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao selecionar os campos: ' . $e->getMessage()
            ];
        }

        return [
            'status' => 'success',
            'pager' => $pager,
            'data' => $clientes
        ];

    }

}
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

     public function deleteCliente($id)
    {
        try {
            if (!$this->clienteModel->find($id)) {
                return [
                    'status' => 'error',
                    'message' => 'Cliente não encontrado.'
                ]; // Cliente não encontrado
            } else {
                $this->clienteModel->delete($id);
                return [
                    'status' => 'success',
                    'message' => 'Cliente excluído com sucesso.'
                ]; // Cliente excluído com sucesso
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao excluir o cliente: ' . $e->getMessage()
            ];
        }
        }
        
    }

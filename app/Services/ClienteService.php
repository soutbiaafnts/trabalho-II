<?php

namespace App\Services;

use App\Models\ClienteModel;
use App\Models\EstadoModel;
use App\Models\MunicipioModel;

class ClienteService
{
    protected ClienteModel $clienteModel;
    protected EstadoModel $estadoModel;
    protected MunicipioModel $municipioModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
        $this->estadoModel = new EstadoModel();
        $this->municipioModel = new MunicipioModel();
    }

    private function validateClienteData(array $data): void {
        $validation = service('validation');

        $validation->setRules(
            [
                'nome' => 'required',
                'estado_id' => 'required|integer',
                'municipio_id' => 'required|integer'
            ],
            [
                'nome' => 'O campo nome é obrigatório.',
                'estado_id' => 'O campo estado_id é obrigatório e deve ser um número inteiro.',
                'municipio_id' => 'O campo municipio_id é obrigatório e deve ser um número inteiro.'
            ]
        );

        if (!$validation->run($data)) {
            throw new \InvalidArgumentException(
                json_encode($validation->getErrors())
            );
        }
    }

    public function getClienteById($id)
    {
        try {
            $cliente = $this->clienteModel->find($id);

            if (!$cliente) {
                return [
                    'status' => 'error',
                    'message' => 'Cliente não encontrado.'
                ];
            }

            return [
                'status' => 'success',
                'data' => $cliente
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao buscar o cliente: ' . $e->getMessage()
            ];
        }
    }

    public function getEstadoByCliente($clienteId)
    {
        try {
            $cliente = $this->clienteModel->find($clienteId);

            if (!$cliente) {
                return [
                    'status' => 'error',
                    'message' => 'Cliente não encontrado.'
                ];
            }

            $estado = $this->estadoModel->find($cliente['estado_id']);
            
            if (!$estado) {
                return [
                    'status' => 'error',
                    'message' => 'Estado não encontrado para o cliente.'
                ];
            }

            return [ 'status' => 'success', 'data' => $estado ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao buscar o estado do cliente: ' . $e->getMessage()
            ];
        }
    }

    public function getMunicipioByCliente($clienteId)
    {
        try {
            $cliente = $this->clienteModel->find($clienteId);

            if (!$cliente) {
                return [
                    'status' => 'error',
                    'message' => 'Cliente não encontrado.'
                ];
            }

            $municipio = $this->municipioModel->find($cliente['municipio_id']);
            
            if (!$municipio) {
                return [
                    'status' => 'error',
                    'message' => 'Município não encontrado para o cliente.'
                ];
            }

            return [ 'status' => 'success', 'data' => $municipio ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao buscar o município do cliente: ' . $e->getMessage()
            ];
        }
    }

    public function getAllClientes() {
        try {
            $clientes = $this->clienteModel->paginate(10);
            $pager = $this->clienteModel->pager;

            $data = [];

            foreach ($clientes as $cliente) {
                $cliente = (array) $cliente;

                $estado = $this->getEstadoByCliente($cliente['id']);
                $municipio = $this->getMunicipioByCliente($cliente['id']);

                $cliente['estado'] = $estado['data']['nome'] ?? null;
                $cliente['municipio'] = $municipio['data']['nome'] ?? null;

                unset($cliente['estado_id'], $cliente['municipio_id']);

                $data[] = $cliente;
            }

            return [
                'status' => 'success',
                'pager' => $pager,
                'data' => $data
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao buscar clientes: ' . $e->getMessage()
            ];
        }
    }

    public function createCliente(array $data) {
        try {
            $this->validateClienteData($data);
            $this->clienteModel->insert($data);
            return [
                'status' => 'success',
                'message' => 'Cliente criado com sucesso.'
            ];
        } catch (\InvalidArgumentException $e) {
            return [
                'status' => 'error',
                'message' => 'Erro de validação: ' . $e->getMessage()
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao criar o cliente: ' . $e->getMessage()
            ];
        }
    }


}



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
                'nome' => 'required|min_length[3]',
                'cpf' => 'required|numeric|exact_length[11]',
                'estado_id' => 'required|integer',
                'municipio_id' => 'required|integer'
            ],
            [
                'nome' => [
                    'required' => 'O campo Nome é obrigatório.', 
                    'min_length' => 'O campo Nome deve ter pelo menos 3 caracteres.'
                ],
                'cpf' => [
                    'required' => 'O campo CPF é obrigatório.',
                    'numeric' => 'O campo CPF deve conter apenas números.',
                    'exact_length' => 'O campo CPF deve conter exatamente 11 dígitos.'
                ],
                'estado_id' => [
                    'required' => 'O campo Estado é obrigatório.',
                    'integer' => 'O campo Estado deve ser um número inteiro.'
                ],
                'municipio_id' => [
                    'required' => 'O campo Município é obrigatório.',
                    'integer' => 'O campo Município deve ser um número inteiro.'
                ]
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
                'message' => 'Erro de validação. Verifique os campos.',
                'errors' => json_decode($e->getMessage(), true)
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao criar o cliente: ' . $e->getMessage()
            ];
        }
    }


}



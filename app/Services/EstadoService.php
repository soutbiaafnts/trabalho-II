<?php

namespace App\Services;

use App\Models\EstadoModel;

class EstadoService
{
    protected EstadoModel $estadoModel;

    public function __construct() {
        $this->estadoModel = new EstadoModel();
    }

    public function getAllEstados() {
        try {

            $estados = $this->estadoModel->select('id, nome')->orderBy('nome')->findAll();

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao buscar estados: ' . $e->getMessage()
            ];
        }

        return [
            'status' => 'success',
            'data' => $estados
        ];
    }

    public function getEstadoById($id)
    {
        try {
            $estado = $this->estadoModel->find($id);

            if (!$estado) {
                return [
                    'status' => 'error',
                    'message' => 'Estado não encontrado.'
                ];
            }

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao selecionar o estado: ' . $e->getMessage()
            ];
        }

        return [
            'status' => 'success',
            'data' => $estado
        ];
    }
}
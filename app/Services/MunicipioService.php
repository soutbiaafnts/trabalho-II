<?php
namespace App\Services;

use App\Models\MunicipioModel;

class MunicipioService
{
    protected $municipioModel;

    public function __construct()
    {
        $this->municipioModel = new MunicipioModel();
    }

    public function getMunicipiosByEstado($estadoId)
    {
        try {

            $municipios = $this->municipioModel->select('id, nome')->where('estado_id', $estadoId)->findAll();
        
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao buscar municípios: ' . $e->getMessage()
            ];
        }

        if (empty($municipios)) {
            return [
                'status' => 'error',
                'message' => 'Nenhum município encontrado para o estado selecionado.'
            ];
        }

        return [
            'status' => 'success',
            'data' => $municipios
        ];
    }

    public function getMunicipioById($id)
    {
        try {
            $municipio = $this->municipioModel->find($id);

            if (!$municipio) {
                return [
                    'status' => 'error',
                    'message' => 'Município não encontrado.'
                ];
            }

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao selecionar o município: ' . $e->getMessage()
            ];
        }

        return [
            'status' => 'success',
            'data' => $municipio
        ];
    }
}
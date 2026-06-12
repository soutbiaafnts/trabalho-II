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
        /*
            Retorna a lista de municípios de um estado específico.
            gerando o SQL: SELECT id, nome FROM municipios WHERE estado_id = $estadoId
        */

        try {

            $municipios = $this->municipioModel->select('id, nome')->where('estado_id', $estadoId)->findAll();
        
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao selecionar os campos: ' . $e->getMessage()
            ];
        }

        if (empty($municipios)) {
            return [
                'status' => 'error',
                'message' => 'Nenhum município encontrado para o estado selecionado.'
            ];
        }

        $r = [
            'status' => 'success',
            'data' => $municipios
        ];

        return $r;
    }
}
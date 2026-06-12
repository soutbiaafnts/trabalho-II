<?php

namespace App\Controllers;

use App\Services\EstadoService;
use App\Services\MunicipioService;

class Municipios extends BaseController
{
    public function getByEstado($estadoId)
    {

        
        if (!$this->request->isAJAX()) {
            //throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            //Erro 403
            return $this->response->setStatusCode(403)->setBody( 'Acesso não autorizado' );
        }
    

        $municipioService = service('municipio');

        $r = $municipioService->getMunicipiosByEstado($estadoId);

        return $this->response->setJSON($r);
    }
}
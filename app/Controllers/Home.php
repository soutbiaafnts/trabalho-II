<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $estadoService = service('estado');

        $r = $estadoService->getEstados();


        if ($r['status'] === 'error') {
            return $r['message'];
        }

        $estados = $r['data'];



        return view( 'index', ['estados' => $estados] ) ;
    }
}
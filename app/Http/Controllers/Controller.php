<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Services\HorarioService;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $horarioService;

    public function __construct (HorarioService $horarioService) {
        $this->horarioService = $horarioService;
    }

    public function criar (Request $request) {
        return  response()
        ->json($this->horarioService->criar($request->input("horarios")));
    }
}

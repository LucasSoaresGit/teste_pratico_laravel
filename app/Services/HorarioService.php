<?php
namespace App\Services;

use App\Horarios;

class HorarioService {

    private $result;

    public function __construct(Horarios $horario){
        $this->horarios = $horario;
    }

    public function criar ($listaHorarios = []) {

        // foreach ($listaHorarios as $value) {
        //     $horario = new Horarios();
        //     $horario->fill($value);
        //     $horario->save();
        // }

        $this->agruparPorHora();
        $this->maiorOcorrenciaEMedia();
        $this->maiorDiferenca();

        return $this->result;
    }



    public function agruparPorHora () {
        $this->result['agrupadosPorHora'] = $this->horarios->select(\DB::raw('count(*) as quantidade, horario'))->groupBy('horario')->get();        
    }

    public function maiorOcorrenciaEMedia () {      
        $maiorhorario = 0;
        $maiorhorarioreplicado = 0;
       
        foreach ($this->result['agrupadosPorHora'] as $chave => $valor) {
        
            if($valor->horario > 1) {
              $maiorhorario = $chave;
            }
            // Dos horários que se repetem o maior é este index;
            // if($valor->quantidade > 1) {
            //     $maiorhorarioreplicado = $chave;
            // }
        }
        
        $this->result['mediaOcorrencia'] = count($this->result['agrupadosPorHora']) / $this->horarios->count();        
        $this->result['maioresOcorrencia'] = $this->result['agrupadosPorHora'][$maiorhorario]->horario;
    }
    
    public function maiorDiferenca () {
        $min = $this->horarios->min('horario');  
        $max = $this->horarios->max('horario');  

        $this->result['maiorDiferenciaHorarios']['min'] = $min;
        $this->result['maiorDiferenciaHorarios']['max'] = $max;
    }
}
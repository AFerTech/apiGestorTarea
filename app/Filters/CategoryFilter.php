<?php

namespace App\Filters;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;



    class CategoryFilter extends ApiFilter{

        // parametros para filtrar los modelos
        protected $saveParams = [

            'titulo' => ['eq'],

        ];
        // mapear columnas a filtrar
        protected $columnMap = [

        ];
        // mapeo de los operadores
        protected $operatorMap = [
            'eq' => '=',
            
        ];


    }


?>

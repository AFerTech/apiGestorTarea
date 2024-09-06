<?php

namespace App\Filters;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;



    class TasksFilter extends ApiFilter{

        // parametros para filtrar los modelos
        protected $saveParams = [

            'titulo' => ['eq'],
            'prioridad' => ['eq'],
            'estatus' => ['eq','ne'],
            'fechaVencimiento' => ['eq','gt','lt','lte','gte'],
            'categoryId' => ['eq'],
            'userId' => ['eq']
        ];
        // mapear columnas a filtrar
        protected $columnMap = [
            'fechaVencimiento' => 'fecha_vencimiento',
            'categoryId' => 'category_id',
            'userId' => 'user_id'
        ];
        // mapeo de los operadores
        protected $operatorMap = [
            'eq' => '=',
            'ne' => '!=',
            'lt' => '<',
            'lte' => '<=',
            'gt' => '>',
            'gte' => '>='
        ];


    }


?>

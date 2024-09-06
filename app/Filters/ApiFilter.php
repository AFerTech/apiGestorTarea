<?php

namespace App\Filters;
use Illuminate\Http\Request;

    class apiFilter{
        // parametros para filtrar los modelos
        protected $saveParams = [];
        // mapear columnas a filtrar
        protected $columnMap = [];
        // mapeo de los operadores
        protected $operatorMap = [];




    public function transform (Request $request){

        $eloQuery= [];
        foreach($this->saveParams as  $parm => $operators){
            $query = $request->query($parm);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$parm] ?? $parm;
            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;

    }
}
?>

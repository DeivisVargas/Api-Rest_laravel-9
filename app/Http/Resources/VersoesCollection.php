<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VersoesCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     * Podemos mudar o nome do indice da resposta atraves da variavel $wrap
     *
     * @var string|null
     */
    public static $wrap = 'data';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        //criando a lista de dados que vai retornar na colection
        return [
            'data'  => VersaoResource::collection($this->collection)
        ];
    }
}

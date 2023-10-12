<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdiomaResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     * Podemos mudar o nome do indice da resposta atraves da variavel $wrap
     *
     * @var string|null
     */
    public static $wrap = 'data';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id ,
            'nome'      => $this->nome,
            //'versoes'   => $this->whenLoaded('versoes') //busca o relacionamento definido no model mas somente vai trases um dado
            'versoes'   => new VersoesCollection($this->whenLoaded('versoes')),
            //whenLoaded tras apenas caso tenha cido carregado, ou chamado a rota para isso
            //se nao utilizar podera traser lista de versao em ocasioes que ela nao for chamada
            'links' => [
                [
                    'rel'       => 'Alterar um idioma',
                    'type'      => 'PUT',
                    'link'      => route('idioma.update',$this->id)
                ],
                [
                    'rel'       => 'Excluir um idioma',
                    'type'      => 'DELETE',
                    'link'      => route('idioma.destroy',$this->id)
                ]
            ]
        ];
    }
}

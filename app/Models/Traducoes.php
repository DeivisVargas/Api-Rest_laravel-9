<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traducoes extends Model
{
    use HasFactory;

    //Define os parametros que a model irá receber
    protected $fillable = ['nome','abreviacao','idioma_id'];
}

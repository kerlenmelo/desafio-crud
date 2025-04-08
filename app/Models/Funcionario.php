<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    // Define que os campos podem ser preenchidos em massa sem apresentar erro.
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'genero',
    ];
}

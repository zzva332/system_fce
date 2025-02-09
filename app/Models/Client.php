<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "type_id",
        "document"
    ];

    public function get_type_id_name() {
        if ($this->type_id == 'CE') return 'Cedula de extranjeria';
        else if ($this->type_id == 'TI') return 'Tarjeta de identidad';
        else return 'Cedula de identidad';
    }
}

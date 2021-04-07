<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GenerationModel extends Model
{
    protected $table = 'generations';
    protected $fillable = ([
        'id', 'generation', 'years', 'created_at', 'updated_at', 'deleted_at'
    ]);

    protected $primary = 'id';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed             name
 * @property mixed             article
 * @property array|string|null birth_date
 * @property string            photo
 */
class Criminal extends Model
{
    //protected $guarded;
    protected $fillable = [
        'name',
        'photo',
        'birth_date',
        'article'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    public $timestamps = false;

    protected $fillable = [
        'img',
        'skills',
        'title',
        'description',
        'urlRepository',
        'urlWebsite',
        'visible',
        'sort',
    ];

    protected $casts = [
     'skills' => 'array'
   ];

}

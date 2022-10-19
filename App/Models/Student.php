<?php

namespace App\Models;

class Student extends Model
{
    /**
     * @var string
     */
    protected string $table = 'students';

    /**
     * @var array|string[]
     */
    protected array $fillable = [
        'name',
        'surname',
        'age',
        'group_id'
    ];
}
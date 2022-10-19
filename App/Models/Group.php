<?php

namespace App\Models;

class Group extends Model
{
    /**
     * @var string
     */
    protected string $table = 'groups';

    /**
     * @var array|string[]
     */
    protected array $fillable = [
        'name'
    ];
}
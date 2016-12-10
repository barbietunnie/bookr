<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Book Model
 */
class Book extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var assertArrayHasKey
     */
    protected $fillable = ['title', 'description', 'author'];
}

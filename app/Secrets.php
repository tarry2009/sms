<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
class Secrets extends Model
{
    protected $table = 'secrets';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_id', 'secret_name', 'encrypted_secret',
    ];

}

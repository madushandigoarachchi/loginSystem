<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey='id';
    public $timestamps=false;
    public static $unguarded=true;
   
    protected $fillable = [
        'fullname',
        'email',
        'password'];

    
    protected $hidden = ['password'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexType extends Model
{
    use HasFactory;


    protected $table = "index_type";
    protected $fillable = ['type', 'value', 'date'];
}
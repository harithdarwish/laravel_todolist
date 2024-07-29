<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    //task, is_done is new table that we add
    protected $table = "todo";
    protected $fillable = ["task", "is_done"];


}

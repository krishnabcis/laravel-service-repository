<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'is_staff'];

    public const IS_ADMIN = 1;
    public const IS_PRINCIPAL = 2;
    public const IS_TEACHER = 3;
    public const IS_STUDENT = 4;
}

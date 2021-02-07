<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PasswordReset
 * @package App\Models
 */
class PasswordReset extends Model
{
    use HasFactory, SoftDeletes;

    const UPDATED_AT = null;

    /**
     * @var string[]
     */
    protected $fillable = [
        'email', 'token'
    ];
}

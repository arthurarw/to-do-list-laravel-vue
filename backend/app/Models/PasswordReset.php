<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * @package App\Models
 */
class PasswordReset extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * @var string[]
     */
    protected $fillable = [
        'email', 'token'
    ];
}

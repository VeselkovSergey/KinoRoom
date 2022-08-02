<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string refer
 * @property string client_ip_address
 */
class Refers extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}

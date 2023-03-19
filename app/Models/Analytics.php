<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string data
 * @property string client_ip_address
 */
class Analytics extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}

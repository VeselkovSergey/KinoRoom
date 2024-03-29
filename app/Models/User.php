<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string email
 * @property string password
 * @property string status
 * @property string email_verified_at
 * @property string subscription_start_date
 * @property string subscription_end_date
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'status',
        'email_verified_at',
        'subscription_start_date',
        'subscription_end_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkSubscription()
    {
        $subscriptionEndDate = Carbon::parse($this->subscription_end_date);
        $diff = $subscriptionEndDate->diffInDays(now()->format('Y-m-d'), false);
        if ($diff > 0) {
            return false;
        }
        return true;
    }
}

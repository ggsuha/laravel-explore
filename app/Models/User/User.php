<?php

namespace App\Models\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'gender',
        'birth_date',
        'phone_code',
        'phone_number',
        'password',
        'email_verified_at',
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function (User $user) {
            $user->generateUserId();
        });
    }

    /**
     * Generate user ID, for user view (instead usual ID)
     *
     * @return void
     */
    public function generateUserId()
    {
        $currentYear    = now()->year;
        $latestUser     = $this->query()
            ->withTrashed()
            ->whereYear('created_at', $currentYear)
            ->orderBy('user_id', 'desc')
            ->first();

        $latestId = (int) substr(optional($latestUser)->user_id, 10, 5) + 1;

        $userId = sprintf('JMH-' . $currentYear . '-' . '%05d', $latestId);

        $this->user_id = $userId;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['cnpj', 'name', 'url', 'email', 'logo', 'subscription', 'expires_at', 'subscription_id',
        'subscription_active', 'subscription_suspended'
    ];

    // Um tenant pode ter vários usuários e um usuário só pode estar ligado a um tenant
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

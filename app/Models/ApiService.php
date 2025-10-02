<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    protected $fillable = ['name'];

    public function tokenTypes()
    {
        return $this->belongsToMany(TokenType::class, 'api_service_token_types');
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}

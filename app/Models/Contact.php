<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'phone', 'company', 'subject', 'message', 'source', 'preferred_date', 'preferred_time', 'contact_method', 'ip_address', 'user_agent'])]
class Contact extends Model
{
    use Notifiable;

    protected $table = 'contacts';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}

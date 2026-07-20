<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'customer_name',
        'issue_description',
        'priority_level',
        'created_at',
        'responded_at',
        'resolved_at',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'responded_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];
}
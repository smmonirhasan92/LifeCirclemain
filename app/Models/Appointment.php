<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'whatsapp_number',
        'service_type',
        'transaction_id',
        'appointment_date',
        'appointment_time',
        'message',
        'status',
        'payment_amount',
        'is_paid',
    ];
}

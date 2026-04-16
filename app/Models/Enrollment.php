<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'whatsapp_number',
        'service_type',
        'category',
        'message',
        'transaction_id',
        'status',
    ];
    /**
     * Get the teacher profile associated with the enrollment.
     */
    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class);
    }

    /**
     * Get the appointment associated with the enrollment.
     */
    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}

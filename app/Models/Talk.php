<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Talk extends Model {
    
    protected $fillable = [
        'title', 
        'description', 
        'start_time',
        'end_time', 
        'location',
        'qr_code',
        'event_id', 
        'speaker_id'
    ];


    /**
     * Generate QR code for the talk
     */
    public function generateQrCode()
    {
        // Generar un código único para la URL de asistencia
        $uniqueCode = md5($this->id . $this->event_id . time());
        
        // Guardar el código en la base de datos
        $this->qr_code = $uniqueCode;
        $this->save();

        // Generar el QR con la URL de asistencia
        $url = route('attendance.mark', ['code' => $uniqueCode]);
        return QrCode::size(300)->generate($url);
    }

    /**
     * Get the QR code URL for attendance
     */
    public function getQrCodeUrl()
    {
        return route('attendance.mark', ['code' => $this->qr_code]);
    }

    /**
     * realción de Talk con speaker
     */
    public function speaker() {
        return $this->belongsTo(Speaker::class);
        }


    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function survey() {
        return $this->hasOne(Survey::class);
    }

}
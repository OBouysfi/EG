<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','license_key','type', 'start_date', 'end_date', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getSupportExpiryDateAttribute()
    {
        if ($this->activated_at) {
            return Carbon::parse($this->activated_at)->addMonths(6)->format('D M d H:i:s T Y');
        }
        return 'Non activé'; 
    }
}

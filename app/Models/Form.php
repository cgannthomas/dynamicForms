<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\FormField;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_name',
        'is_active'
    ];
    
    public function setFormNameAttribute($value)
    {
        $this->attributes['form_name'] = ucwords(strtolower($value));
    }

    public function formfields() {
        return $this->hasMany(FormField::class);
    }
}

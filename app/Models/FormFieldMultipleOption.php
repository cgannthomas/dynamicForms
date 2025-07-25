<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Log;
use App\Models\FormField;

class FormFieldMultipleOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_field_id',
        'options_value',
        'options_text'
    ];

    public function setOptionsValueAttribute($value)
    {
        $this->attributes['options_value'] = str_replace(' ', '_' , strtolower($value));
    }

    public function setOptionsTextAttribute($value)
    {
        $this->attributes['options_text'] = ucwords(str_replace('_', ' ' , strtolower($value)));
    }

    public function getOptionsValueStringAttribute()
    {
        Log::info($this->formFieldMultipleOptions->pluck('options_value'));
        return $this->formFieldMultipleOptions->pluck('options_value')->implode(',');
    }
    
    public function formfields() {
        return $this->belongsTo(FormField::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use Log;

use App\Models\Form;
use App\Models\FormFieldMultipleOption;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'field_label',
        'field_name',
        'field_type',
        'is_required'
    ];

    public function setFieldLabelAttribute($value)
    {
        $this->attributes['field_label'] = ucwords(strtolower($value));
    }

    public function setFieldNameAttribute($value)
    {
        $this->attributes['field_name'] = str_replace(' ', '_' , strtolower($value));
    }

    public function getOptionsValueStringAttribute()
    {
        Log::info($this->formFieldMultipleOptions->pluck('options_value'));
        return $this->formFieldMultipleOptions->pluck('options_value')->implode(',');
    }

    public function form() {
        return $this->belongsTo(Form::class);
    }

    public function formFieldMultipleOptions() {
        return $this->hasMany(FormFieldMultipleOption::class);
    }
}

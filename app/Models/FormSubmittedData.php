<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Log;
use App\Models\Form;

class FormSubmittedData extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'submitted_data'
    ];


    public function form() {
        return $this->belongsTo(Form::class);
    }

}

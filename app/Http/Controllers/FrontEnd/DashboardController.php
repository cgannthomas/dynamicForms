<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $forms = Form::select('id', 'form_name')->where('is_active', 1)->get()->toArray();
        return view('front-end.dashboard', compact('forms'));
    }

}

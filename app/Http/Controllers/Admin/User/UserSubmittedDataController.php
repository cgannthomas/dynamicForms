<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\Admin\SubmittedDataListDataTable;
use App\Models\Form;
use App\Models\FormSubmittedData;

class UserSubmittedDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubmittedDataListDataTable $dataTable)
    {
        return $dataTable->render('admin.user.submitted_forms_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $formData = FormSubmittedData::with('form')->find($id);
            
            if (empty($formData)) {
                return redirect()->route('admin.users.index');
            }

            return view('admin.user.view_submitted_form_data', compact('formData'));
        } catch (Exception $e) {
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            FormSubmittedData::destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'User data deleted successfully!',
                'code' => 200
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}

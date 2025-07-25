<?php

namespace App\Http\Controllers\Admin\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests\NewFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Repositories\Form\FormRepository;
use App\DataTables\Admin\FormListDataTable;
use App\Models\Form;

class FormController extends Controller
{

    public function __construct(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;

    }

    /**
     * Display a listing of the resource.
     */
    public function index(FormListDataTable $dataTable)
    {
        return $dataTable->render('admin.forms.forms_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.forms.add_forms');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewFormRequest $request)
    {
        try {
            DB::beginTransaction();

            $newForm = $this->formRepository->createNew($request->all());
            
            DB::commit();

            
            return response()->json($newForm, 200);
        } catch (Exception $e) {            
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $e,
                'code' => $statusCode
            ], $statusCode);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $formData = Form::with('formfields.formFieldMultipleOptions')->find($id);
            
            if (empty($formData)) {
                return redirect()->route('admin.forms.index');
            } else {
                $formData = $formData->toArray();
            }
            return view('admin.forms.view_form', compact('formData'));
        } catch (Exception $e) {
            return redirect()->route('admin.forms.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $formData = Form::with('formfields.formFieldMultipleOptions')->find($id);
            
            if (empty($formData)) {
                return redirect()->route('admin.forms.index');
            } /*else {
                $formData = $formData->toArray();
            }*/
            return view('admin.forms.edit_forms', compact('formData'));
        } catch (Exception $e) {
            return redirect()->route('admin.forms.index');
        }
    }

    /**
     * Update the specified resource in storage. 
     */
    public function update(UpdateFormRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $newForm = $this->formRepository->update($id, $request->all());
            
            DB::commit();

            
            return response()->json($newForm, 200);
        } catch (Exception $e) {            
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $e,
                'code' => $statusCode
            ], $statusCode);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Form::destroy($id);
            return response()->json(['message' => 'Form deleted successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}

@extends('admin.layouts.dashboard-layout')
@section('pageTitle','View Form')

@push('css')
<style>
.form-button {
    pointer-events: none;
    opacity: 0.5;
}
  </style>
@endpush
@section('breadcrumbs')

	@php
        $breadcrumbTitle = 'New Form';
        $breadcrumbs = [
            ['route' => route('admin.forms.index'), 'title' => 'Forms', 'status' => ''],
            ['title' => 'View Form', 'route' => null, 'status' => 'active']
            ];
    @endphp
    @component('components.breadcrumb',compact('breadcrumbs','breadcrumbTitle')) @endcomponent

@endsection

@section('content')
  <div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
			<!--begin::Card title-->
      <div class="card-title m-0">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
          <h3 class="fw-bolder m-0">{{ $formData['form_name']}}</h3>
          <div title="{{ $formData['is_active'] ? 'Active' : 'In-active'}}" class="position-absolute bottom-0 start-100 mb-6 bg-{{ $formData['is_active'] ? 'success' : 'danger'}} rounded-circle border border-4 border-white h-20px w-20px"></div>
				</div>
      </div>
      <!--end::Card title-->
    </div>
    <!--begin::Card header-->
      <!--begin::Content-->
					<!--begin::Card body-->
          <div class="card-body border-top p-9">
            <!--begin::Input group--> 
            @foreach($formData['formfields'] as $fields)
              <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label {{ $fields['is_required'] ? 'required' : ''}} fw-bold fs-6">{{ $fields['field_label']}}</label>
								<!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                  @php $required = $fields['is_required'] ? 'required' : ''; @endphp
                  @if(in_array($fields['field_type'], config('constants.INPUT_FIELD_LIST')))
                    <input placeholder="Enter Data" type="{{$fields['field_type']}}" autocomplete="{{$fields['field_name']}}" name="{{$fields['field_name']}}" class="form-control form-control-lg" {{$required}}>
									@elseif($fields['field_type'] == 'select' && $fields['form_field_multiple_options'])
                    <select name="{{$fields['field_name']}}" aria-label="Select a {{$fields['field_label']}}" {{$required}} data-control="select2" data-placeholder="Select a {{$fields['field_label']}}" class="form-select form-select-lg select2-hidden-accessible">
								      <option value="">Select {{$fields['field_label']}}..</option>
                      @foreach($fields['form_field_multiple_options'] as $options)
								        <option value="{{$options['options_value']}}">{{$options['options_text']}}</option>
                      @endforeach
                    </select>
                  @elseif($fields['field_type'] == 'radio' && $fields['form_field_multiple_options'])
                    <div class="d-flex align-items-center mt-3">

                      @foreach($fields['form_field_multiple_options'] as $options)
                          <label class="form-check form-check-inline form-check-solid me-5">
														<input class="form-check-input" {{$required}} name="{{$fields['field_name']}}" type="radio" value="{{$options['options_value']}}">
														<span class="fw-bold ps-2 fs-6">{{$options['options_text']}}</span>
													</label>
                      @endforeach
                    </div>
                  @endif
                  <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
										<!--end::Col-->
							</div>
              
            @endforeach
          </div>
          <!--begin::Actions-->
          <div class="card-footer d-flex justify-content-center py-6 px-9">
            <button type="reset" class="btn btn-light btn-active-light-primary me-2 form-button">Discard</button>
            <button type="submit" class="btn btn-primary form-button">Save</button>
					</div>
          <!--end::Actions-->
  </div>
@endsection
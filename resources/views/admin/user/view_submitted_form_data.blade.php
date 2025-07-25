@extends('admin.layouts.dashboard-layout')
@section('pageTitle','View Submitted Data')

@push('css')
<style>
input {
    pointer-events: none;
}
  </style>
@endpush
@section('breadcrumbs')

	@php
        $breadcrumbTitle = 'New Form';
        $breadcrumbs = [
            ['route' => route('admin.users.index'), 'title' => 'User Data', 'status' => ''],
            ['title' => 'View Submitted Data', 'route' => null, 'status' => 'active']
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
          <h3 class="fw-bolder m-0">{{ $formData->form->form_name}}</h3></div>
      </div>
      <!--end::Card title-->
    </div>
    <!--begin::Card header-->
      <!--begin::Content-->
					<!--begin::Card body-->
          <div class="card-body border-top p-9">
            <!--begin::Input group--> 
            @foreach(json_decode($formData->submitted_data) as $key => $data)
              <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ ucwords(str_replace('_', ' ', $key))}}</label>
								<!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                  <input value="{{ ucwords(str_replace('_', ' ', $data))}}" class="form-control form-control-lg form-control-solid" type="text"/>
                </div>
										<!--end::Col-->
							</div>
              
            @endforeach
          </div>
          <!--begin::Actions-->
          <div class="card-footer d-flex justify-content-center py-6 px-9">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-active-light-primary me-2 form-button"> Back </a>
					</div>
          <!--end::Actions-->
  </div>
@endsection
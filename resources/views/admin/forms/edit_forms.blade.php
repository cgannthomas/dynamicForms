@extends('admin.layouts.dashboard-layout')
@section('pageTitle','Edit Form')

@section('breadcrumbs')

	@php
        $breadcrumbTitle = 'New Form';
        $breadcrumbs = [
            ['route' => route('admin.forms.index'), 'title' => 'Forms', 'status' => ''],
            ['title' => 'Edit Form', 'route' => null, 'status' => 'active']
            ];
    @endphp
    @component('components.breadcrumb',compact('breadcrumbs','breadcrumbTitle')) @endcomponent

@endsection

@section('content')
    <div class="card-body pt-0">
    <!--begin::Content-->
		<div id="kt_account_profile_details" class="collapse show">
			<!--begin::Form-->
			<form id="update-dynamic-form" class="form" data-url="{{route('admin.forms.update', $formData->id)}}" method="PATCH">
				<br/>
					<!--begin::Input group-->
					<div class="row mb-6">
						<!--begin::Label-->
						<label class="col-lg-4 col-form-label required fw-bold fs-6">Form Title</label>
						<!--end::Label-->
						<!--begin::Col-->
						<div class="col-lg-8 fv-row">
							<input type="text" name="form_name" value="{{$formData->form_name}}" class="form-control form-control-lg form-control-solid" placeholder="Form Title" />
						</div>
						<!--end::Col-->
					</div>
                    <input type="hidden" name="id" value="{{$formData->id}}"/>
					<!--end::Input group-->
                    @csrf
                    <!--begin::Input group-->
					<div class="row mb-6">
						<!--begin::Label-->
						<label class="col-lg-4 col-form-label required fw-bold fs-6">Form Status</label>
						<!--end::Label-->
						<div class="col-lg-8 d-flex align-items-center">
                            <div class="form-check form-check-solid  fv-row">
                                <input class=" w-45px h-30px" type="radio" name="is_active" id="form-active" value="1" {{$formData->is_active == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="form-active">Active</label>
                            </div>
                            <div class="form-check form-check-solid form-switch fv-row">
                                <input class=" w-45px h-30px" type="radio" name="is_active" id="form-inactive" value="0" {{$formData->is_active == 1 ? '' : 'checked'}}>
                                <label class="form-check-label" for="form-inactive">Inactive</label>
                            </div>
                        </div>
					</div>
					<!--end::Input group-->
					<!--begin::Input group-->
					<div class="row mb-6 card-footer" id="form-field">
                        <h3 class="fw-bolder m-0">Form Fields</h3>
					</div>
					<!--end::Input group-->

                    <!--begin field appending-->
                    <div class="table-responsive" id="append-formfields">
                        <!--begin::Table-->
                        <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9 {{$formData->formfields->isNotEmpty() ? '' : 'dynamic_form_class'}}" id="dynamic-form">
							<!--begin::Table head-->
                            <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                <tr class="fw-6">
                                    <th class="w-250px min-w-175px ps-9">Label</th>
                                    <th class="min-w-100px min-w-100px">Name</th>
									<th class="min-w-100px min-w-100px">Field Type</th>
									<th class="min-w-125px min-w-125px"></th>
									<th class="min-w-125px">Mandatory or not</th>
									<th class="w-50px">Action</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-6 fw-bold text-gray-600">
                                @if($formData->formfields->isNotEmpty())
                                    @foreach($formData->formfields as $fields)
                                        <tr id="tr-">
                                        <input type="hidden" value="{{$fields->id}}" class="field_id" name="field[][field_id]"/>

                                            <td>
                                                <input type="text" value="{{$fields->field_label}}" name="field[][field_label]" class="form-control field_label" placeholder="Label" />
                                            </td>
                                            <td>
                                                <input type="text"  value="{{$fields->field_name}}" name="field[][field_name]" class="form-control field_name" placeholder="Name" />
                                            </td>
                                            <td>
                                                <select name="field[][field_type]" class="form-select field_type">
                                                    <option value="" readonly>Select field type..</option>
                                                    @foreach(config('constants.FIELD_TYPE') as $key => $value)
                                                        @php 
                                                            $selected = '';

                                                            if($key == $fields->field_type) {
                                                                $selected = 'selected';
                                                            }

                                                        @endphp
                                                        <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="multiple_option">
                                                @if($fields->formFieldMultipleOptions->isNotEmpty())
                                                    <input type="text" value="{{$fields->options_value_string}}" name="field[][options]" class="form-control multi_options" placeholder="comma separated" title="Enter select options as comma(,) separated" />
                                                @endif
                                            </td>
                                            <td >
                                                <div class="form-check form-switch fv-row" >
                                                    <input class="form-check-input w-35px h-20px is_required" type="checkbox" name="field[][is_required]" {{$fields->is_required == 1 ? 'checked' : ''}} id="field-mandatory">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm btn-active-light-primary remove_field">
                                                    <span class="fa fa-trash" style="font-size:1rem"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
							</tbody>
                        </table>
                    </div>
                    <!--end::field appending-->
                    <!--begin::Input group-->
					<div class="row mb-6">
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-primary" id="add-fields">Add Fields</button>	
                        </div>
					</div>
					<!--end::Input group-->
                    
				<!-- </div> -->
				<!--end::Card body-->
				<!--begin::Actions-->
				<div class="card-footer d-flex justify-content-center py-6 px-9">
					<button type="reset" class="btn btn-light btn-active-light-primary me-2" id="reset-form">Discard</button>
					<button type="Submit" class="btn btn-primary" id="dynamic-form-update">Update Form</button>
				</div>
				<!--end::Actions-->
			</form>
			<!--end::Form-->
		</div>
		<!--end::Content-->

        </div>
        <!--end::Card body-->
        <!-- begin::clone table tr for appending form fields -->
        <div id="clone-tr" >
            <table><tbody>
                <tr id="tr-">
                    <input type="hidden" value="" class="field_id" name="field[][field_id]"/>
                    <td>
                        <input type="text" name="field[][field_label]" class="form-control field_label" placeholder="Label" />
                    </td>
                    <td>
                        <input type="text" name="field[][field_name]" class="form-control field_name" placeholder="Name" />
                    </td>
                    <td>
                        <select name="field[][field_type]" class="form-select field_type">
                            <option value="" readonly>Select field type..</option>
                            @foreach(config('constants.FIELD_TYPE') as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
							@endforeach
                        </select>
                    </td>
                    <td class="multiple_option"></td>
                    <td >
                        <div class="form-check form-switch fv-row" >
                            <input class="form-check-input w-35px h-20px is_required" type="checkbox" name="field[][is_required]" id="field-mandatory">
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm btn-active-light-primary remove_field">
                            <span class="fa fa-trash" style="font-size:1rem"></span>
                        </button>
                    </td>
                </tr>	
            </tbody></table>
            
        </div>
        <div id="clone-multiple-option-textbox">
            <input type="text" name="field[][options]" class="form-control multi_options" placeholder="comma separated" title="Enter select options as comma(,) separated" />
        </div>
        <!--end::clone content-->

        @push('js')	
            <script src="{{ asset('admin-panel/assets/js/form/update_form.js') }}"></script>
        @endpush
@endsection
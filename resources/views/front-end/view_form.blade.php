@extends('front-end.layouts.dashboard-layout')
@section('pageTitle','Forms')

@push('css')
<style>
.field_required {
    border-color: red !important;
}
  </style>
@endpush

@section('content')

<section class=" d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">
        <div class="row">
            
            
           <div class="card mb-5 mb-xl-10">
                <div class="d-flex justify-content-end py-6 px-9">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </div>
                <!--begin::Card header-->
                <div class="card-header border-0 justify-content-center">
                    <!--begin::Card title-->
                        
                    <div class="card-title m-0 ">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <h3 class="fw-bolder m-0">{{ $formData['form_name']}}</h3>
                        </div>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
				<!--begin::Card body-->
                <form action="{{ route('form.submit', $formData['id']) }}" method="POST">
                    @csrf
                    <div class="card-body border-top p-9">
                            <!--begin::Input group--> 
                            <input type="hidden" name="id" value="{{$formData['id']}}"/>
                            @foreach($formData['formfields'] as $fields)
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label {{ $fields['is_required'] ? 'required' : ''}} fw-bold fs-6">{{ $fields['field_label']}}</label>
                                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                    @php $required = $fields['is_required'] ? 'required' : ''; @endphp

                                    @if(in_array($fields['field_type'], config('constants.INPUT_FIELD_LIST')))
                                        <input placeholder="Enter Data" value="{{ old($fields['field_name']) }}" type="{{$fields['field_type']}}" autocomplete="{{$fields['field_name']}}" name="{{$fields['field_name']}}" class="form-control form-control-lg @error($fields['field_name']) field_required  @enderror" {{$required}}>
                                    @elseif($fields['field_type'] == 'select' && $fields['form_field_multiple_options'])
                                    
                                        <select name="{{$fields['field_name']}}" aria-label="Select a {{$fields['field_label']}}" {{$required}} data-control="select2" data-placeholder="Select a {{$fields['field_label']}}" class="form-select @error($fields['field_name']) field_required  @enderror form-select-lg select2-hidden-accessible">
                                            <option value="">Select {{$fields['field_label']}}..</option>
                                            
                                            @foreach($fields['form_field_multiple_options'] as $options)
                                                @php $selected = (old($fields['field_name']) == $options['options_value']) ? "selected" : ''; @endphp
                                                <option value="{{$options['options_value']}}" {{$selected}}>{{$options['options_text']}}</option>
                                            @endforeach
                                        </select>
                                    @elseif($fields['field_type'] == 'radio' && $fields['form_field_multiple_options'])
                                        <div class="d-flex align-items-center mt-3">
                                            @php $i = 0; @endphp

                                            @foreach($fields['form_field_multiple_options'] as $options)
                                                <label class="form-check form-check-inline form-check-solid me-5">
                                                    <input class="form-check-input @error($fields['field_name']) field_required  @enderror" {{$required}} name="{{$fields['field_name']}}" {{$i?"" : 'checked'}}  type="radio" value="{{$options['options_value']}}">
                                                    <span class="fw-bold ps-2 fs-6">{{$options['options_text']}}</span>
                                                </label>
                                                @php $i++; @endphp
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="fv-plugins-message-container invalid-feedback">@error($fields['field_name']) {{$message}} @enderror</div>
                                </div>
                                <!--end::Col-->
                            </div>
                            
                            @endforeach
                    </div>
                    <!--begin::Actions-->
                    <x-flash />
                    <div class="card-footer d-flex justify-content-center py-6 px-9">
                        <button type="reset" id="reset-form" class="btn btn-light btn-active-light-primary me-2 form-button">Discard</button>
                        <button type="submit" class="btn btn-primary form-button">Save</button>
                    </div>
                    <!--end::Actions-->
                </form>

            </div>
        </div>
    </div>
</section>

@push('js')
<script src="{{asset('front-end/js/dashboard.js')}}"></script>
@endpush

@endsection
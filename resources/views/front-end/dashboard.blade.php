@extends('front-end.layouts.dashboard-layout')
@section('pageTitle','Dashboard')


@section('content')

<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 mx-auto">
                <h1 class="text-white text-center">Choose your Form</h1>
                <select name="form_name" id="Form-name" aria-label="Select a form" data-control="select2" data-placeholder="Select a form" class="form-select form-select-lg select2-hidden-accessible">
					<option value="">Select a form..</option>
                    @foreach($forms as $data)
                        <option value="{{ route('form.view', $data['id'])}}">{{$data['form_name']}}</option>
					@endforeach
                </select>
            </div>
        </div>
    </div>
</section>
    <x-flash />

@push('js')
<script src="{{asset('front-end/js/dashboard.js')}}"></script>
@endpush

@endsection
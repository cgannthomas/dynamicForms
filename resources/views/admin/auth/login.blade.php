@extends('admin.auth.layouts.login-layout')
@section('pageTitle','Admin Login')

@section('content')
	@php
		$old_input = $errors = "";
	@endphp
	@if(session('success') || session('errors') || session('commonError'))
        @php
            $old_input = session()->getOldInput();
        @endphp
    @endif
	@if(session('errors'))
		@php
            $errors = session('errors');
        @endphp
    @endif
    <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="{{ route('admin.login') }}" class="mb-12">
						DynamicForms
						<!-- <img alt="Logo" src="{{ asset('admin-panel/media/logos/logo-1.svg')}}" class="h-40px" /> -->
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form method="POST" action="{{ route('admin.post-login') }}" novalidate>
                            @csrf
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign In to DynamicForms</h1>
								<!--end::Title-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="form-control form-control-lg {{($errors && array_key_exists('email', $errors)) ? 'is-invalid' : ''  }}" type="text" name="email" autocomplete="off" value="{{$old_input ? $old_input['email'] :'' }}" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!--end::Label-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="form-control form-control-lg {{($errors && array_key_exists('password', $errors)) ? 'is-invalid' : ''  }}" type="password" name="password" autocomplete="off"  value="{{$old_input ? $old_input['password'] :'' }}"/>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							@if(session('commonError'))
								<div class="fv-plugins-message-container invalid-feedback">
									<div>{{session('commonError')}}</div>
								</div>
							@endif
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Continue</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<!--end::Submit button-->
							</div>
							
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
	<!--end::Main-->
@endsection

@extends('admin.layouts.dashboard-layout')
@section('pageTitle','Form Lists')


@section('breadcrumbs')

	@php
        $breadcrumbTitle = 'Forms List';
        $breadcrumbs = [['route' => "route('admin.forms.index')", 'title' => 'Forms', 'status' => ''], ['title' => 'Lists', 'route'
                => null, 'status' => 'active']];
    @endphp
    @component('components.breadcrumb',compact('breadcrumbs','breadcrumbTitle')) @endcomponent

@endsection

@section('content')

	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
						
					</div>
					<!--begin::Card title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<!--begin::Toolbar-->
						<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
							
							<!--begin::Add customer-->
							<a href="{{ route('admin.forms.create') }}" type="button" class="btn btn-primary">Create New Form</a>
							<!--end::Add customer-->
						</div>
						<!--end::Toolbar-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-0">
					<!--begin::Table-->
					@component('components.datatable',compact('dataTable')) @endcomponent
					
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
	</div>
	@push('js')	
        <script src="{{ asset('admin-panel/assets/js/form/form_actions.js') }}"></script>
    @endpush
@endsection
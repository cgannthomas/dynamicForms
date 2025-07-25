@extends('admin.layouts.dashboard-layout')
@section('pageTitle','Admin Dashboard')

@section('breadcrumbs')

	@php
        $breadcrumbTitle = 'Dashboard';
        $breadcrumbs = [];
                @endphp
                @component('components.breadcrumb',compact('breadcrumbs','breadcrumbTitle')) @endcomponent

@endsection

@section('content')

	<br/>
	<!--begin::Card body-->
	<div class="card-body pt-0">
		<h3>Loading......</h3>
	</div>
	<!--end::Card body-->
@endsection
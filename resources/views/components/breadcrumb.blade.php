    
    <div class="flex-grow-1 flex-shrink-0 me-5">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{$breadcrumbTitle}}</h1>
			<!--end::Title-->
			@if($breadcrumbTitle !== 'Dashboard')
			<!--begin::Separator-->
			<span class="h-20px border-gray-200 border-start mx-3"></span>
			<!--end::Separator-->
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
				<!--begin::Item-->
				<li class="breadcrumb-item text-muted">
					<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
				</li>
				<!--end::Item-->
				@foreach ($breadcrumbs as $breadcrumb)
				<!--begin::Item-->
				<li class="breadcrumb-item">
					<span class="bullet bg-gray-200 w-5px h-2px"></span>
				</li>
				<!--end::Item-->
				<!--begin::Item-->
				<li class="breadcrumb-item {{ $breadcrumb['status'] == 'active' ?  'text-dark' : 'text-muted' }}">
					@isset($breadcrumb['route'])
						<a href="{{ $breadcrumb['route'] }}" class="{{ $breadcrumb['status'] == 'active' ?  'text-dark' : 'text-muted' }}">
                    @endisset
                        {{ $breadcrumb['title'] }}

                    @isset($breadcrumb['route'])
                        </a>
                    @endisset
				</li>
				<!--end::Item-->
				@endforeach
			</ul>
			<!--end::Breadcrumb-->
			@endif
		</div>
		<!--end::Page title-->
	</div>
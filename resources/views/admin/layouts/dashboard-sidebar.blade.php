	<div id="kt_aside" class="aside pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
		<!--begin::Brand-->
		<div class="aside-logo py-8" id="kt_aside_logo">
			<!--begin::Logo-->
			<a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
				<img alt="Logo" src="{{asset('admin-panel/images/site-logo.jpeg')}}" class="h-45px logo" />
			</a>
			<!--end::Logo-->
		</div>
		<!--end::Brand-->
		<!--begin::Aside menu-->
		<div class="aside-menu flex-column-fluid" id="kt_aside_menu">
			<!--begin::Aside Menu-->
			<div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
				<!--begin::Menu-->
				<div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
					<div class="menu-item py-2 here">
						<a class="menu-link menu-center" href="{{ route('admin.dashboard') }}" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
							<span class="menu-icon me-0">
								<span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black"></path>
										<path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black"></path>
										<path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black"></path>
										<path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black"></path>
									</svg>
								</span>
							</span>
							<span class="menu-title">Dashboard</span>
						</a>
					</div>
					<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
						<span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
							<span class="menu-icon me-0">
								<i class="bi bi-chat-square-text fs-2"></i>
							</span>
							<span class="menu-title">Forms</span>
						</span>
						<div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
							<div class="menu-item">
								<a class="menu-link" href="{{ route('admin.forms.create') }}">
									<span class="menu-bullet">
										<span class="menu-arrow"></span>
									</span>
									<span class="menu-title">Create New Form</span>
								</a>
							</div>
							<div class="menu-item">
								<a class="menu-link" href="{{ route('admin.forms.index') }}">
									<span class="menu-bullet">
										<span class="menu-arrow"></span>
									</span>
									<span class="menu-title">Form Lists</span>
								</a>
							</div>
						</div>
					</div>
					
					<!-- <div class="menu-item py-2">
						<span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
							<span class="menu-icon me-0">
								<i class="bi bi-people fs-2"></i>
							</span>
							<span class="menu-title">Users</span>
						</span>
					</div> -->
					<div class="menu-item py-2">
						<a href="{{ route('admin.logout') }}" class="menu-link menu-center" >
							<span class="menu-icon me-0">
								<span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"></rect>
										<path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"></path>
										<path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"></path>
									</svg>
								</span>
							</span>
							<span class="menu-title">Logout</span>
						</a>
					</div>
					
				</div>
				<!--end::Menu-->
			</div>
			<!--end::Aside Menu-->
		</div>
		<!--end::Aside menu-->
	</div>
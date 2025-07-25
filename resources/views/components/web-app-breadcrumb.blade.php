            

            <div class="col-lg-5 col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-gray-600">
                                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600">Home</a>
                                    </li> 
                                    @foreach ($breadcrumbs as $breadcrumb)
                                    
                                        <li class="breadcrumb-item {{ $breadcrumb['status'] == 'active' ?  'active' : 'text-gray-600' }}">
                                            @isset($breadcrumb['route'])
                                            <a href="{{ $breadcrumb['route'] }}" class="{{ $breadcrumb['status'] == 'active' ?  'text-gray-400' : 'text-gray-600' }}">
                                                @endisset

                                                {{ $breadcrumb['title'] }}

                                                @isset($breadcrumb['route'])
                                            </a>
                                            @endisset
                                        </li>
                                    @endforeach
                                </ol>
                            </nav>

                            <h2 class="text-white">{{$breadcrumbTitle}}</h2>
                        </div>
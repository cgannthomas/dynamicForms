<div class="card-body">
    <!-- load datatable -->
    {!! $dataTable->table() !!}
</div>


@push('css')
<link type="text/css" href="{{ asset('/vendor/DataTables/datatables.min.css')}}" rel="stylesheet">
@endpush

@push('js')
<script type="text/javascript" src="{{ asset('/vendor/DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('/vendor/DataTables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}
@endpush

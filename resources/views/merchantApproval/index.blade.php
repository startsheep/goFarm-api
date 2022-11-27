@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">List Merchant <strong>Approval</strong></h1>

            @if (session('message'))
                {!! session('message') !!}
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(function() {
            $("body").on('click', "input[role='switch']", function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ url('api/user/merchant/update-status') }}/" + id,
                    type: "post",
                    headers: {
                        "Authorization": "Bearer {{ Session::get('token') }}"
                    },
                    data: {
                        _method: 'put'
                    },
                    success: function(response) {}
                })
            })
        })
    </script>
@endpush

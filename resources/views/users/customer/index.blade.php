@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">List <strong>Customer</strong></h1>

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

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="deleteAdmin" tabindex="-1" aria-labelledby="deleteAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAdminLabel">Deleting data!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="formDelete">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        Are you sure you want to <strong>delete</strong> this data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(function() {
            $("body").on('click', '.btn-delete', function() {
                let route = $(this).data('route');
                $("#formDelete").attr('action', route)
            })
        })
    </script>
@endpush

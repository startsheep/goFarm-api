@php
    use Carbon\Carbon;
@endphp
@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">
                <a href="{{ route('category.index') }}" class="btn">
                    <i class="align-middle" data-feather="arrow-left"></i>
                </a> Create Category
            </h1>

            @if ($errors->any())
                <div class="row col-lg-6">
                    <div class="card bg-danger p-3 text-white">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="row col-lg-6">
                <form class="card mb-3" enctype="multipart/form-data" method="post" action="{{ route('category.store') }}"
                    id="formCreate">
                    @csrf
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="mb-2">
                            <label for="status">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status" checked>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-warning">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formCreate").validate({
                        lang: "id",
                        ignore: "",
                        rules: {
                            name: {
                                required: true
                            },
                        },
                        submitHandler: function(form) {
                            form.submit()
                        }
                    });
                }
            }
            $(D).ready(function($) {
                JQUERY4U.UTIL.setupFormValidation()
            })
        })(jQuery, window, document)
    </script>
@endpush

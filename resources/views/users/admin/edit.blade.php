@php
    use Carbon\Carbon;
@endphp
@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">
                <a onclick="history.back()" class="btn">
                    <i class="align-middle" data-feather="arrow-left"></i>
                </a> Update Admin
            </h1>

            @if ($errors->any())
                <div class="card bg-danger p-3 text-white">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="card mb-3" enctype="multipart/form-data" method="post"
                action="{{ route('web.user.admin.update', $admin->id) }}" id="formUpdate">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email') ?? $admin->email }}">
                    </div>
                    <div class="mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') ?? $admin->name }}">
                    </div>
                    <div class="mb-2">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone') ?? $admin->phone }}">
                    </div>
                    <div class="mb-2 row">
                        <div class="col-lg-6 mb-2">
                            <label for="file">Image</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col-lg-6 mb-2">
                            <img src="{{ $admin->image }}" class="img-fluid mt-lg-3" alt="{{ $admin->name }}"
                                width="250" height="250"
                                onerror="this.error=null; this.src='{{ asset('template/img/no-images.png') }}'">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-warning">Refresh</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('js')
    <script>
        (function($, W, D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    $("#formUpdate").validate({
                        lang: "id",
                        ignore: "",
                        rules: {
                            email: {
                                required: true,
                                email: true,
                            },
                            name: {
                                required: true
                            },
                            phone: {
                                required: true,
                                number: true
                            },
                            file: {
                                extension: "jpg|png|jpeg"
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

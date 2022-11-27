@php
    use Carbon\Carbon;
@endphp
@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            @if (session('message'))
                {!! session('message') !!}
            @endif
            <h1 class="h3 mb-3">
                <a href="{{ route('merchant.index') }}" class="btn">
                    <i class="align-middle" data-feather="arrow-left"></i>
                </a> Profile Detail
                <strong>{{ $merchant->name }}</strong>
            </h1>
            <div class="card mb-3">
                <div class="card-body text-center">
                    <img src="{{ $merchant->image }}" alt="{{ $merchant->name }}" class="img-fluid rounded-circle mb-2"
                        width="128" height="128"
                        onerror="this.error=null; this.src='{{ asset('template/img/no-images.png') }}'">
                    <h5 class="card-title mb-0">{{ strtoupper($merchant->name) }}</h5>
                    <div class="text-muted mb-2">{{ $merchant->role->name }}</div>

                    <div class="d-flex justify-content-center">
                        <label
                            class="text-{{ $merchant->status ? 'muted' : 'danger' }} label-deactive me-2">Deactive</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                {{ $merchant->status ? 'checked' : '' }}>
                        </div>
                        <label class="text-{{ $merchant->status ? 'success' : 'muted' }} label-active">Active</label>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"> <i class="align-middle" data-feather="mail"></i>
                            Email address <a href="mailto:{{ $merchant->email }}">{{ $merchant->email }}</a></li>

                        <li class="mb-1"> <i class="align-middle" data-feather="phone"></i> Phone number <a
                                href="tel:{{ $merchant->phone }}">{{ $merchant->phone }}</a></li>
                        <li class="mb-1"> <i class="align-middle" data-feather="tag"></i> Created by
                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $merchant->created_at)->diffForHumans() }}</li>
                    </ul>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><a href="#">staciehall.co</a></li>
                        <li class="mb-1"><a href="#">Twitter</a></li>
                        <li class="mb-1"><a href="#">Facebook</a></li>
                        <li class="mb-1"><a href="#">Instagram</a></li>
                        <li class="mb-1"><a href="#">LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script>
        $(function() {
            $("input[role='switch']").click(function() {
                $.ajax({
                    url: "{{ route('api.user.merchant.update.status', $merchant->id) }}",
                    type: "post",
                    headers: {
                        "Authorization": "Bearer {{ Session::get('token') }}"
                    },
                    data: {
                        _method: 'put'
                    },
                    success: function(response) {
                        if (response.data == 'active') {
                            $(".label-active").addClass("text-success").removeClass(
                                'text-muted')
                            $(".label-deactive").addClass("text-muted").removeClass(
                                'text-danger')
                        }

                        if (response.data == 'deactive') {
                            $(".label-active").addClass("text-muted").removeClass(
                                'text-success')
                            $(".label-deactive").addClass("text-danger").removeClass(
                                'text-muted')
                        }
                    }
                })
            })
        })
    </script>
@endpush

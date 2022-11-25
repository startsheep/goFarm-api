@php
    use Carbon\Carbon;
@endphp
@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><a href="{{ route('web.user.admin.index') }}"><i class="align-middle"
                        data-feather="arrow-left"></i></a> Profile Detail
                <strong>{{ $admin->name }}</strong>
            </h1>
            <div class="card mb-3">
                <div class="card-body text-center">
                    <img src="img/avatars/avatar-4.jpg" alt="{{ $admin->name }}" class="img-fluid rounded-circle mb-2"
                        width="128" height="128">
                    <h5 class="card-title mb-0">{{ strtoupper($admin->name) }}</h5>
                    <div class="text-muted mb-2">{{ $admin->role->name }}</div>

                    <div>
                        <a class="btn btn-warning btn-sm" href="#">Edit</a>
                        <a class="btn btn-danger btn-sm" href="#">
                            Delete</a>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"> <i class="align-middle" data-feather="mail"></i>
                            Email address <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a></li>

                        <li class="mb-1"> <i class="align-middle" data-feather="phone"></i> Phone number <a
                                href="tel:{{ $admin->phone }}">{{ $admin->phone }}</a></li>
                        <li class="mb-1"> <i class="align-middle" data-feather="tag"></i> Created by
                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $admin->created_at)->diffForHumans() }}</li>
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

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
            <h1 class="h3 mb-3"><a href="{{ route('doctor.index') }}" class="btn"><i class="align-middle"
                        data-feather="arrow-left"></i></a> Profile Detail
                <strong>{{ $doctor->name }}</strong>
            </h1>
            <div class="card mb-3">
                <div class="card-body text-center">
                    <img src="{{ $doctor->image }}" alt="{{ $doctor->name }}" class="img-fluid rounded-circle mb-2"
                        width="128" height="128"
                        onerror="this.error=null; this.src='{{ asset('template/img/no-images.png') }}'">
                    <h5 class="card-title mb-0">{{ strtoupper($doctor->name) }}</h5>
                    <div class="text-muted mb-2">{{ $doctor->role->name }}</div>

                    <div>
                        <a class="btn btn-warning btn-sm" href="{{ route('doctor.edit', $doctor->id) }}">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteDoctor">
                            Delete</a>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"> <i class="align-middle" data-feather="mail"></i>
                            Email address <a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a></li>

                        <li class="mb-1"> <i class="align-middle" data-feather="phone"></i> Phone number <a
                                href="tel:{{ $doctor->phone }}">{{ $doctor->phone }}</a></li>
                        <li class="mb-1"> <i class="align-middle" data-feather="tag"></i> Created by
                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $doctor->created_at)->diffForHumans() }}</li>
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

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="deleteDoctor" tabindex="-1" aria-labelledby="deleteDoctorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteDoctorLabel">Deleting data!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('doctor.destroy', $doctor->id) }}" method="post" id="formDelete">
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

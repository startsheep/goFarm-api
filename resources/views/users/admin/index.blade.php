@extends('dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">List Account <strong>Admin</strong></h1>

            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button class="btn btn-primary">Add Admin</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>
                                            <a href="{{ route('web.user.admin.show', $admin->id) }}" class="btn btn-info"><i
                                                    class="align-middle" data-feather="eye"></i></a>
                                            <a href="{{ route('web.user.admin.edit', $admin->id) }}"
                                                class="btn btn-warning"><i class="align-middle" data-feather="edit"></i></a>
                                            <a href="{{ route('web.user.admin.destroy', $admin->id) }}"
                                                class="btn btn-danger"><i class="align-middle"
                                                    data-feather="trash-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

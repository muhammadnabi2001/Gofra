@extends('Layout.main')
@section('title')
@section('contents')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-12 m-3">
                <!-- Button trigger modal -->
                <a href="{{ route('role.create-page') }}" class="btn btn-primary">Create</a>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Roles</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Activity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $index => $role)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @if($role->status)
                                                    <span style="padding: 0.5rem 1rem; border-radius: 20px; font-size: 1rem; color: white; background-color: #28a745;">Active</span>
                                                @else
                                                    <span style="padding: 0.5rem 1rem; border-radius: 20px; font-size: 1rem; color: white; background-color: #dc3545;">Inactive</span>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <a href="{{route('role.update-page',$role->id)}}" class="btn btn-warning">Update</a>
                                                <!-- Delete Form -->
                                                <form method="POST" action="{{ route('role.delete', $role->id) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('permission.create') }}">
                                @csrf
                            
                                <div class="mb-3">
                                    <label for="groupSelect" class="form-label">Select Group</label>
                                    <select class="form-control" id="groupSelect" name="group_id">
                                        <option value="">-- Select a group --</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                                {{ $group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Permission name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                        placeholder="Input rolename" value="{{ old('name') }}">
                                </div>
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Permissions</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $index => $permission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->group->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#updateexampleModal{{ $permission->id }}">
                                                Update
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="updateexampleModal{{ $permission->id }}"
                                                tabindex="-1"
                                                aria-labelledby="updateexampleModalLabel{{ $permission->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="updateexampleModalLabel">
                                                                Modal title</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('permission.update', $permission->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                            
                                                                <div class="mb-3">
                                                                    <label for="groupSelect" class="form-label">Select Group</label>
                                                                    <select class="form-control" id="groupSelect" name="group_id">
                                                                        <option value="">-- Select a group --</option>
                                                                        @foreach ($groups as $group)
                                                                            <option value="{{ $group->id }}" 
                                                                                {{ $permission->group_id == $group->id ? 'selected' : '' }}>
                                                                                {{ $group->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            
                                                                <div class="mb-3">
                                                                    <label for="updateexampleInputEmail1" class="form-label">Role name</label>
                                                                    <input type="text" class="form-control" id="updateexampleInputEmail1" name="name"
                                                                        value="{{ $permission->name }}">
                                                                </div>
                                                            
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                            

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Form -->
                                            <form method="POST" action="{{ route('permission.delete', $permission->id) }}"
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
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

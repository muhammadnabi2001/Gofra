@extends('Layout.main')
@section('title','Raw-Materials')
@section('contents')
<div class="container-fluid">
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
                            <form method="POST" action="{{ route('materials.create') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Raw-Materail Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Input raw-material name" value="{{ old('name') }}">
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
    </div>
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
        
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Materials</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $index => $material)
                                    <tr>
                                        <td class="text-center">{{ ($materials->currentPage() - 1) * $materials->perPage() + $loop->iteration }}</td>
                                        <td class="text-center">{{ $material->name }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$material->id}}">
                                                Update
                                            </button>
                                
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$material->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$material->id}}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('materials.update',$material->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="name" class="form-label">Raw-Materail Name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Input raw-material name" value="{{$material->name}}">
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
                                            <form method="POST" action="{{ route('materials.delete', $material->id) }}"
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
                        {{ $materials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

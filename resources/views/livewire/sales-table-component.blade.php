<div>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <a href="{{route('sale.index')}}" class="btn btn-primary m-3">Make sale</a>
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
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Sale List</h3>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer name</th>
                                        <th>Total price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale )
                                    <tr >
                                        <td>{{$sale->id}}</td>
                                        <td>{{$sale->customer->name}}</td>
                                        <td>{{$sale->total_price}}</td>
                                        <td>{{$sale->status}}</td>
                                        <td>
                                            <a href="{{route('sale.update',$sale->id)}}" class="btn btn-warning">Update</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

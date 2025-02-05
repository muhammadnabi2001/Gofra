@extends('Layout.main')
@section('title','Invoice_Materials')
@section('contents')
<div class="container">
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
        <div class="row m-3">
            <div class="col-12">
                <a href="{{ route('invoice_materials.create-page') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Invoices</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">date</th>
                                    <th class="text-center">text</th>
                                    <th class="text-center">invoiceMaterials</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $index => $invoice)
                                    <tr>
                                        <td class="text-center">{{ ($invoices->currentPage() - 1) * $invoices->perPage() + $loop->iteration }}</td>
                                        <td class="text-center">{{ $invoice->company_name }}</td>
                                        <td class="text-center">{{ $invoice->date }}</td>
                                        <td class="text-center">{{ $invoice->text }}</td>
                                        <td class="text-center">
                                            @if($invoice->invoiceMaterials->count() > 0)
                                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#invoiceMaterialsModal{{ $invoice->id }}">
                                                    <i class="fas fa-cogs"></i> View Materials
                                                </button>
                                        
                                                <!-- Modal -->
                                                <div class="modal fade" id="invoiceMaterialsModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="invoiceMaterialsModalLabel{{ $invoice->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="invoiceMaterialsModalLabel{{ $invoice->id }}">Invoice Materials</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    @foreach ($invoice->invoiceMaterials as $material)
                                                                        <li class="list-group-item">
                                                                            {{ $material->material->name }} - {{ $material->quantity }} {{ $material->unit }} at {{ $material->price }} each
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                No materials found
                                            @endif
                                        </td>
                                        
                                        
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
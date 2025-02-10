<div>
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
    <div class="row m-3">
        <div class="col-12">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProductModal">
                + Add Product
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Products List</h3>
            
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Product 1</td>
                        <td><img src="path_to_image/product1.jpg" style="width: 50px; height: 50px; object-fit: cover;"></td>
                        <td>
                            <button class="btn btn-info btn-sm">View</button>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveProduct">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" wire:model="name">
                        </div>

                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control" wire:model="image">
                        </div>

                        <label>Materials</label>
                        <div>
                            @foreach($materials as $index => $material)
                                <div class="input-group mb-2">
                                    <select class="form-control" wire:model="materials.{{ $index }}.material">
                                        <option value="">Select Material</option>
                                        @foreach($allMaterials as $mat)
                                            <option value="{{ $mat->id }}">{{ $mat->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" class="form-control ml-2" wire:model="materials.{{ $index }}.quantity" placeholder="Quantity">
                                    <input type="hidden" wire:model="materials.{{ $index }}.unit">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" wire:click="removeMaterial({{ $index }})">&times;</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-success btn-sm mt-2" wire:click="addMaterial">+ Add Material</button>
                        <button type="submit" class="btn btn-primary mt-3">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('openModal', () => {
        $('#addProductModal').modal('show');
    });

    Livewire.on('closeModal', () => {
        $('#addProductModal').modal('hide');
    });
</script>
@endpush

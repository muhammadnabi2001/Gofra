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
            <button type="button" class="btn btn-primary btn-sm" wire:click="$set('showModal', true)">
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
                        <th>Product ing</th>
                        <th>Product Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product )
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>
                            @foreach($product->ingredients as $ingredient)
                                <p>{{ $ingredient->material->name}}-{{$ingredient->value}}</p>
                            @endforeach
                        </td>
                        
                        <td>
                            @if($product->img)
                                <img src="{{ asset('storage/' . $product->img) }}" alt="Product Image" width="100" height="100">
                            @else
                                No image available
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" wire:click="editProduct({{$product->id}})">
                                Edit
                            </button>
                            <div class="modal fade {{ $showeditModal ? 'show' : '' }}" id="addProductModal" tabindex="-1" role="dialog" style="{{ $showeditModal ? 'display: block;' : 'display: none;' }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add New Product</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form wire:submit.prevent="updateProduct({{$product->id}})">
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input type="text" class="form-control" wire:model="editName">
                                                </div>
                        
                                                <div class="form-group">
                                                    <label>Product Image</label>
                                                    <input type="file" class="form-control" wire:model="editImage">
                                                    <img src="{{ asset('storage/' . $editImage) }}" alt="Product Image" width="100" height="100">
                                                </div>
                                                <label>Materials</label>
                                                <div>
                                                    <!-- Edit materiallar uchun foreach -->
                                                    @foreach($editMaterials as $index => $material)
                                                        <div class="input-group mb-2">
                                                            <select class="form-control" wire:model="editMaterials.{{ $index }}.material">
                                                                <option value="">Materialni tanlang</option>
                                                                @foreach($allMaterials as $mat)
                                                                    <option value="{{ $mat->id }}" 
                                                                        @if($mat->id == $material['material']) selected @endif>
                                                                        {{ $mat->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                
                                                            <input type="number" class="form-control ml-2" wire:model="editMaterials.{{ $index }}.quantity" 
                                                                   value="{{ $material['quantity'] }}" placeholder="Miqdor">
                                                
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-danger" wire:click="removeMaterial({{ $index }})">&times;</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                
                                                <!-- Yangi material qo'shish -->
                                                <button type="button" class="btn btn-success btn-sm mt-2" wire:click="addMaterial">+ Add Material</button>
                                                

                                                <!-- Tugmalarni bitta chiziqda joylashtirish uchun flex container -->
                                                <div class="d-flex justify-content-between mt-3">
                                                    <!-- Save Product tugmasi -->
                                                    <button type="button" class="btn btn-secondary" wire:click="$set('showeditModal', false)">Close Modal</button>
                                                    <button type="submit" class="btn btn-primary">Save Product</button>
                        
                                                    <!-- Close Modal tugmasi -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade {{ $showModal ? 'show' : '' }}" id="addProductModal" tabindex="-1" role="dialog" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
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

                        <!-- Tugmalarni bitta chiziqda joylashtirish uchun flex container -->
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Save Product tugmasi -->
                            <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">Close Modal</button>
                            <button type="submit" class="btn btn-primary">Save Product</button>

                            <!-- Close Modal tugmasi -->
                        </div>
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

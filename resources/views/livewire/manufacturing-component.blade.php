<div>
    <!-- Add Production Button -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
    <div class="m-3">
        <button type="button" class="btn btn-primary" wire:click="openModal">
            <i class="fas fa-plus"></i> Add Production
        </button>
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
    <!-- Products Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Total Count</th>
                        <th>Waste Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product->name }}</td>
                        <td>{{$product->total_count}}</td>
                        <td>{{$product->waste_count}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade {{ $showModal ? 'show' : '' }}" style="{{ $showModal ? 'display: block;' : 'display: none;' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Production</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveProduction">
                       
                        <div class="form-group">
                            <label>Select Product</label>
                            <select class="form-control" wire:model="selectedProduct">
                                <option value="">Select a Product</option>
                                @foreach($allProducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Product Count -->
                        <div class="form-group">
                            <label>Product Count</label>
                            <input type="number" class="form-control" wire:model="productCount" min="1" max="{{$maxCount}}">
                        </div>

                        <label>Machines & Users</label>
                        <div>
                            @foreach($machines as $index => $machine)
                                <div class="input-group mb-2">
                                    <!-- Machine Select -->
                                    <select class="form-control" wire:model="machines.{{ $index }}.machine_id">
                                        <option value="">Select Machine</option>
                                        @foreach($allMachines as $mach)
                                            <option value="{{ $mach->id }}">{{ $mach->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- User Select -->
                                    <select class="form-control ml-2" wire:model="machines.{{ $index }}.user_id">
                                        <option value="">Select User</option>
                                        @foreach($allUsers as $usr)
                                            <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Remove Button -->
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" wire:click="removeMachine({{ $index }})">&times;</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Add More Machines -->
                        <button type="button" class="btn btn-success btn-sm mt-2" wire:click="addMachine">
                            <i class="fas fa-plus"></i> Add Machine
                        </button>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Production</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@push('scripts')
<script>
    Livewire.on('openModal', () => {
        $('#addProductionModal').modal('show');
    });

    Livewire.on('closeModal', () => {
        $('#addProductionModal').modal('hide');
    });
</script>
@endpush

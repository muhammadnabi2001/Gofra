<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <label>Select Customer</label>
                    <select class="form-control" wire:model="selected_customer">
                        <option value="">-- Select Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $index => $sale)
                        <tr>
                            <td>
                                <select class="form-control" wire:model="sales.{{ $index }}.product_id" wire:change="updatePrice({{ $index }})">
                                    <option value="">-- Select Product --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" wire:model="sales.{{ $index }}.quantity" min="1" wire:input="validateQuantity({{ $index }})">
                            </td>
                            <td>
                                <input type="text" class="form-control" wire:model="sales.{{ $index }}.price" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" wire:model="sales.{{ $index }}.total" readonly>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click="removeSaleRow({{ $index }})">X</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="btn btn-primary" wire:click="addSaleRow">+ Add Product</button>
                <button class="btn btn-success" wire:click="saveSale">Update Sale</button>
            </div>
        </div>
        <a href="{{route('sale.table')}}" class="btn btn-dark m-2">Back</a>
    </section>
</div>

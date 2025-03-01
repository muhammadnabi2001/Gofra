<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Action History</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <input type="text" wire:model="search" class="form-control" placeholder="Search...">
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Model</th>
                                <th>Action</th>
                                <th>User</th>
                                <th>Data</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ $history->id }}</td>
                                    <td>{{ class_basename($history->actionable_type) }}</td>
                                    <td>{{ $history->action }}</td>
                                    <td>{{ optional($history->user)->name ?? 'System' }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                            wire:click="showDetails({{ $history->id }})">View</button>
                                    </td>
                                    <td>{{ $history->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($isModalOpen)
        <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Action Details</h5>
                        <button type="button" class="close text-white" wire:click="closeModal">&times;</button>
                    </div>
                    <div class="modal-body" style="max-height: 60vh; overflow-y: auto; padding: 20px;">
                        @if ($selectedData)
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%;">ID</th>
                                    <td>{{ $selectedData->id }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ class_basename($selectedData->actionable_type) }}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>{{ $selectedData->action }}</td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>{{ optional($selectedData->user)->name ?? 'System' }}</td>
                                </tr>
                                <tr>
                                    <th>Data</th>
                                    <td>
                                        <pre class="bg-light p-2 rounded">{{ json_encode($selectedData->data, JSON_PRETTY_PRINT) }}</pre>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <td>{{ $selectedData->created_at }}</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

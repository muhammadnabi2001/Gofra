<div class="content-wrapper kanban">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Kanban Board</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kanban Board</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content pb-3">
        <div class="container-fluid h-100">
            <div class="card card-row card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Pending
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-info card-outline">
                        @foreach ($machineproducts as $machineproduct)
                            <div class="card-header">
                                <h5 class="card-title">Product{{ $machineproduct->id }}</h5>
                                <div class="card-tools">
                                    <a wire:click="givepermission({{ $machineproduct->id }})" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            @if ($permission1 == $machineproduct->id)
                                <div class="card-body">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                            disabled>
                                        <label for="customCheckbox1" class="custom-control-label">
                                            {{ $machineproduct->manufacturing->product->name }}
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2"
                                            disabled>
                                        <label for="customCheckbox2" class="custom-control-label">
                                            {{ $machineproduct->manufacturing->total_count }}
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button class="btn btn-sm btn-success"
                                            wire:click="acceptRequest({{ $machineproduct->id }})">
                                            <i class="fas fa-check"></i> Accept
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="card card-row card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Manufactured
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-primary card-outline">
                        @foreach ($manufactured as $manufacture)
                            <div class="card-header">
                                <h5 class="card-title">Product{{ $manufacture->id }}</h5>
                                <div class="card-tools">
                                    <a wire:click="allowance({{ $manufacture->id }})" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            @if ($permission2 == $manufacture->id)
                                <div class="card-body">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                            disabled>
                                        <label for="customCheckbox1" class="custom-control-label">
                                            {{ $manufacture->manufacturing->product->name }}
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2"
                                            disabled>
                                        <label for="customCheckbox2" class="custom-control-label">
                                            {{ $manufacture->manufacturing->total_count }}
                                        </label>
                                    </div>
                                    <div>
                                      <!-- Tugatish Tugmasi -->
                                      <div class="d-flex justify-content-end mt-2">
                                          <button class="btn btn-sm btn-success" wire:click="openModal">
                                              <i class="fas fa-flag-checkered"></i> Tugatish
                                          </button>
                                      </div>
                                  
                                      <!-- Modal -->
                                      @if($showModal)
                                          <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);" tabindex="-1" role="dialog">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title">Ishni Tugatish</h5>
                                                          <button type="button" class="close" wire:click="closeModal">
                                                              <span>&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <div class="form-group">
                                                              <label for="brak">Brak</label>
                                                              <input type="text" id="brak" class="form-control" wire:model.defer="brak">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="count">Count</label>
                                                              <input type="number" id="count" class="form-control" wire:model.defer="count">
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" wire:click="closeModal">Bekor qilish</button>
                                                          <button type="button" class="btn btn-success" wire:click="saveData">Saqlash</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endif
                                  </div>
                                  
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-row card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">
                        In Progress
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Update Readme</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#2</a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                Aenean commodo ligula eget dolor. Aenean massa.
                                Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

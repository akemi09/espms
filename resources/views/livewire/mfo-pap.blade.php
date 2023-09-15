<div>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewMFOPAPModal"><i
                    class="bx bx-plus"></i> Add New MFO/PAP</button>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="query"
                wire:keydown='search'>
        </div>
    </div>
    <div class="table-response text-nowrap mt-3">
        <table class="table mb-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Target Function</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mfo_paps as $mfo_pap)
                    <tr>
                        <td>{{ $mfo_pap->title }}</td>
                        <td>{{ $mfo_pap->target_function->name }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <button wire:click="edit({{ $mfo_pap->id }})" class="dropdown-item"
                                        data-bs-toggle="modal" data-bs-target="#editMFOPAPModal"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</button>
                                    <button wire:click="destroy({{ $mfo_pap->id }})"
                                        onclick="return confirm('You are about to delete MFO/PAP. Continue?') || event.stopImmediatePropagation()"
                                        type="submit" class="btn btn-link dropdown-item"><i
                                            class="bx bx-trash me-1"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Not found</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Target Function</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

        {{ $mfo_paps->links() }}
    </div>

    <!-- Add Office Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="addNewMFOPAPModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New MFO/PAP</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <textarea wire:model="title" type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                                    rows="2" placeholder="e.g Early Procurement and Utilization of Budget"></textarea>
                                @error('title')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="office" class="form-label">Available in</label>
                                <select id="office" class="form-control" wire:model="office" multiple="multiple"
                                    size="10">
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                                Press <code>CTRL</code> to select multiple
                                @error('office')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="target_function" class="form-label">Select Target Function</label>
                                <select class="form-control" wire:model="target_function" id="target_function">
                                    <option value="">Select Option</option>
                                    @foreach ($target_functions as $tf)
                                        <option value="{{ $tf->id }}">{{ $tf->name }}</option>
                                    @endforeach
                                </select>
                                @error('target_function')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click="store" wire:loading.attr="disabled"
                            class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Office Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="editMFOPAPModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit MFO/PAP</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <textarea wire:model="title" type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                                    rows="2" placeholder="e.g Early Procurement and Utilization of Budget">{{ $title }}</textarea>
                                @error('title')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="office" class="form-label">Available in</label>
                                <select class="form-control" wire:model="office" multiple="multiple" size="10">
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                                Press <code>CTRL</code> to select multiple
                                @error('office')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="target_function" class="form-label">Select Target Function</label>
                                <select class="form-control" wire:model="target_function">
                                    <option value="">Select Option</option>
                                    @foreach ($target_functions as $tf)
                                        <option value="{{ $tf->id }}">{{ $tf->name }}</option>
                                    @endforeach
                                </select>
                                @error('target_function')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click="update" wire:loading.attr="disabled"
                            class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

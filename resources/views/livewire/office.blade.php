<div>
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewOfficeModal">
                <i class="bx bx-plus"></i>
                Add New Office
            </button>
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($offices as $office)
                    <tr>
                        <td>{{ $office->name }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <button wire:click="edit({{ $office->id }})" class="dropdown-item"
                                        data-bs-toggle="modal" data-bs-target="#editOfficeModal"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</button>
                                    <button wire:click="destroy({{ $office->id }})"
                                        onclick="return confirm('You are about to delete office. Continue?') || event.stopImmediatePropagation()"
                                        type="submit" class="btn btn-link dropdown-item"><i
                                            class="bx bx-trash me-1"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    No data
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

        {{ $offices->links() }}

    </div>

    <!-- Add Office Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="addNewOfficeModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New Office</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="office_name" class="form-label">Name</label>
                                <input wire:model="office_name" type="text" id="office_name"
                                    class="form-control @error('office_name') is-invalid @enderror"
                                    placeholder="Enter Office Name">
                                @error('office_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click="store" wire:loading.attr="disabled"
                            class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Office Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="editOfficeModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Office</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="office_name" class="form-label">Name</label>
                                <input wire:model="office_name" type="text" id="office_name"
                                    value="{{ $office_name }}"
                                    class="form-control @error('office_name') is-invalid @enderror">
                                @error('office_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click="update({{ $office_id }})" wire:loading.attr="disabled"
                            class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

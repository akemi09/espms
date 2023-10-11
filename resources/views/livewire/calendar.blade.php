<div>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewEventModal"><i
                    class="bx bx-plus"></i> Add New Event</button>
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
                    <th>Event Name</th>
                    <th>From</th>
                    <th>End</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($calendars as $calendar)
                    <tr>
                        <td>{{ $calendar->event_name }}</td>
                        <td>{{ $calendar->event_from }}</td>
                        <td>{{ $calendar->event_end }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <button wire:click="edit({{ $calendar->id }})" class="dropdown-item"
                                        data-bs-toggle="modal" data-bs-target="#editEventModal"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</button>
                                    <button wire:click="destroy({{ $calendar->id }})"
                                        onclick="return confirm('You are about to delete calendar event. Continue?') || event.stopImmediatePropagation()"
                                        type="submit" class="btn btn-link dropdown-item"><i
                                            class="bx bx-trash me-1"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No records</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Event Name</th>
                    <th>From</th>
                    <th>End</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

        {{ $calendars->links() }}
    </div>

    <!-- Add Office Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="addNewEventModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New Event</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="mb-3">
                                <label for="event_name" class="form-label">Event Name</label>
                                <input wire:model="event_name" type="text" id="event_name"
                                    class="form-control @error('event_name') is-invalid @enderror">
                                @error('event_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="event_from" class="form-label">Event From</label>
                                <input wire:model="event_from" type="date" id="event_from"
                                    class="form-control @error('event_from') is-invalid @enderror">
                                @error('event_from')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="event_end" class="form-label">Event End</label>
                                <input wire:model="event_end" type="date" id="event_end"
                                    class="form-control @error('event_end') is-invalid @enderror">
                                @error('event_end')
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
    <div class="modal fade" data-bs-backdrop="static" id="editEventModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Update Event</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="mb-3">
                                <label for="event_name" class="form-label">Event Name</label>
                                <input wire:model="event_name" type="text" id="event_name"
                                    class="form-control @error('event_name') is-invalid @enderror">
                                @error('event_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="event_from" class="form-label">Event From</label>
                                <input wire:model="event_from" type="date" id="event_from"
                                    class="form-control @error('event_from') is-invalid @enderror">
                                @error('event_from')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="event_end" class="form-label">Event End</label>
                                <input wire:model="event_end" type="date" id="event_end"
                                    class="form-control @error('event_end') is-invalid @enderror">
                                @error('event_end')
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

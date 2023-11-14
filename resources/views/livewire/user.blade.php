<div>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUserModal"><i
                    class="bx bx-plus"></i> Add New User</button>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="query"
                wire:keydown='search'>
        </div>
    </div>
    <div class="table-response mt-3">
        <table class="table mb-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Office</th>
                    <th>Designation</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <th>{{ $user->office->name }}</th>
                        <td>{{ $user->designation }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                                <span class="badge bg-label-primary me-1">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{-- @if ($user->id != 1) --}}
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <button wire:click="edit({{ $user->id }})" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</button>
                                        <button wire:click="destroy({{ $user->id }})"
                                            onclick="return confirm('You are about to delete user. Continue?') || event.stopImmediatePropagation()"
                                            type="submit" class="btn btn-link dropdown-item"><i
                                                class="bx bx-trash me-1"></i> Delete</button>
                                    </div>
                                </div>
                            {{-- @endif --}}
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Office</th>
                    <th>Designation</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

        {{ $users->links() }}
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="addNewUserModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New User</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="John Doe">

                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror


                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" wire:model="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="john@example.com">

                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="designation">Designation</label>
                                <input type="text" wire:model="designation"
                                    class="form-control @error('designation') is-invalid @enderror" id="designation"
                                    placeholder="Admin">

                                @error('designation')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="office">Office</label>
                                <select wire:model="office" id="office"
                                    class="form-control @error('office') is-invalid @enderror">
                                    <option value="">Select Office</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>

                                @error('office')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                @foreach ($roles_list as $key => $role)
                                    <div class="form-check">
                                        <input wire:model="roles"
                                            class="form-check-input @error('roles') is-invalid @enderror"
                                            type="checkbox" value="{{ $role['name'] }}" id="role{{ $key }}">

                                        <label class="form-check-label" for="role{{ $key }}">
                                            {{ Str::upper($role['name']) }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('roles')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" wire:model="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password">

                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                <input type="password" wire:model="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation">

                                @error('password_confirmation')
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

    <!-- Edit User Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="editUserModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModalLabel">Edit User</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="John Doe">

                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror


                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" wire:model="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="john@example.com">

                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="designation">Designation</label>
                                <input type="text" wire:model="designation"
                                    class="form-control @error('designation') is-invalid @enderror" id="designation"
                                    placeholder="Admin">

                                @error('designation')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="office">Office</label>
                                <select wire:model="office" id="office"
                                    class="form-control @error('office') is-invalid @enderror">
                                    <option value="">Select Office</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>

                                @error('office')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                @foreach ($roles_list as $key => $role)
                                    <div class="form-check">
                                        <input wire:model="roles"
                                            class="form-check-input @error('roles') is-invalid @enderror"
                                            type="checkbox" value="{{ $role['name'] }}"
                                            id="role{{ $key }}" @checked(in_array($role['name'], $roles))>

                                        <label class="form-check-label" for="role{{ $key }}">
                                            {{ Str::upper($role['name']) }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('roles')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" wire:model="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password">

                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                <input type="password" wire:model="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation">

                                @error('password_confirmation')
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

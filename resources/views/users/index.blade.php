@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add New User</a>
        </div>
    </div>
    <div class="table-response text-nowrap mt-3">
        <table class="table mb-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                                <span class="badge bg-label-primary me-1">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if ($user->id != 1)
                                
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <a href="{{ route('users.edit', $user) }}" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('You are about to delete user. Continue?')" type="submit" class="btn btn-link dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                            @endif
                        </td>
                    </tr>
                @empty
                    No data
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

        {{ $users->links() }}
    </div>
@endsection
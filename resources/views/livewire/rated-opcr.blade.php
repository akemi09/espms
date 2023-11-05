<div>
    <div class="table-response text-nowrap mt-3">
        <table class="table mb-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Office</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($opcr_users as $pcr_user)
                    <tr>
                        <td>{{ $pcr_user->user->name }}</td>
                        <td>{{ $pcr_user->user->office->name }}</td>
                        <td>{{ $pcr_user->user->designation }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('rated.opcr.show', $pcr_user->user_id) }}">View</a>
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
                    <th>Office</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

        {{ $opcr_users->links() }}
    </div>
</div>


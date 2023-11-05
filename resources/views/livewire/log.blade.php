<div>
    <div class="table-response text-nowrap mt-3">
        <table class="table mb-3">
            <thead>
                <tr>
                    <th>Detail</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->causer->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No records</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Detail</th>
                    <th>By</th>
                </tr>
            </tfoot>
        </table>

        {{ $logs->links() }}
    </div>
</div>

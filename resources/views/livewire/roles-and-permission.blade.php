<div>
    <div class="row">
        <div class="table-response text-nowrap mt-3">
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th rowspan="2">Roles</th>
                        <th colspan="4" class="text-center">Set Permissions</th>
                    </tr>
                    <tr>
                        <th>Create</th>
                        <th>Read</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ Str::upper($role->name) }}</td>
                            <td>
                                <input wire:model="permissions"
                                class="form-check-input"
                                type="checkbox" value="{{$role->name}}.create" id="create{{$key}}">
                            </td>
                            <td>
                                <input wire:model="permissions"
                                class="form-check-input"
                                type="checkbox" value="{{$role->name}}.read" id="read{{$key}}">
                            </td>
                            <td>
                                <input wire:model="permissions"
                                class="form-check-input"
                                type="checkbox" value="{{$role->name}}.update" id="update{{$key}}">
                            </td>
                            <td>
                                <input wire:model="permissions"
                                class="form-check-input"
                                type="checkbox" value="{{$role->name}}.delete" id="delete{{$key}}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <button type="button" wire:click="save" wire:loading.attr="disabled"
                            class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

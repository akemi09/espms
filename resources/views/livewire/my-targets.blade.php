<div>
    <div class="row">
        <div class="col-md-12">
            <div class="accordion mt-3" id="accordionExample">
                @foreach ($target_functions as $key => $target_function)
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#accordion{{ $key }}" aria-expanded="false"
                                aria-controls="accordion{{ $key }}">
                                {{ $target_function->name }}
                            </button>
                        </h2>

                        <div id="accordion{{ $key }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($mfo_paps as $key => $mfo_pap)
                                    @if ($key == $target_function->id)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>MFO/PAP</th>
                                                    <th>Targets + Measures</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mfo_pap as $mp)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}. {{ $mp['title'] }}</td>
                                                        <td>
                                                            <button wire:click="edit({{ $mp['id'] }})"
                                                                class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#editTargetModal">View</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Edit Target Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="editTargetModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add/Edit Target</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('layouts.flash')
                        <div class="row">
                            <div class="col mb-3">
                                @if (count($targets) > 0)
                                    @foreach ($targets as $key => $target)
                                        <input type="hidden" wire:model="targets.{{ $key }}.id">
                                        <input wire:model="targets.{{ $key }}.title" type="text"
                                            id="targets.{{ $key }}.title"
                                            class="mb-2 form-control @error('targets.' . $key . '.title') is-invalid @enderror">
                                        <button type="buttn" wire:click.prevent="destroy({{$key}})" class="mb-2 btn btn-danger btn-sm">remove</button>
                                        @error('targets.' . $key . '.title')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endforeach

                                @endif
                                <button type="button" class="btn btn-primary mt-2 float-end" wire:click="addTarget">add</button>
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

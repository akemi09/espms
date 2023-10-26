<div>
    <div class="table-response mt-3 overflow-auto">
        <table class="table mb-3">
            <thead>
                <tr>
                    <th>MFO/PAP</th>
                    <th>Target + Measure</th>
                    <th>Actual Accomplishments</th>
                    <th>Q1</th>
                    <th>E2</th>
                    <th>T3</th>
                    <th>A4</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pcrs as $pcr)
                    <tr>
                        <td>{{ $pcr->mfo_pap->title }}</td>
                        <td>{{ $pcr->targets }}</td>
                        <td>{{ $pcr->actual_accomplishments }}</td>
                        <td>{{ $pcr->q1 }}</td>
                        <td>{{ $pcr->e2 }}</td>
                        <td>{{ $pcr->t3 }}</td>
                        <td>{{ $pcr->a4 }}</td>
                        <td>
                            <button wire:click="rate({{ $pcr->id }})" class="dropdown-item"
                                data-bs-toggle="modal" data-bs-target="#rateIpcrModal"><i
                                    class="bx bx-edit-alt me-1"></i> Rate</button>
                        </td>
                        {{-- <td>{{ $office->name }}</td>
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
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No records</td>
                    </tr>
                @endforelse

                <tr>
                    <td>STRATEGIC FUNCTION (45%)</td>
                    <td colspan="7" class="text-end">{{ number_format($strategic, 2) }}</td>
                </tr>
                <tr>
                    <td>CORE FUNCTIONS (45%)</td>
                    <td colspan="7" class="text-end">{{ number_format($core, 2) }}</td>
                </tr>
                <tr>
                    <td>SUPPORT FUNCTIONS (10%)</td>
                    <td colspan="7" class="text-end">{{ number_format($support, 2) }}</td>
                </tr>
                <tr>
                    <td>TOTAL OVERALL RATING</td>
                    <td colspan="7" class="text-end">{{ number_format($strategic + $core + $support, 2) }}</td>
                </tr>
            </tbody>
        </table>

    </div>

        <!-- Add Office Modal -->
        <div class="modal fade" data-bs-backdrop="static" id="rateIpcrModal" tabindex="-1" style="display: none;"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Rate IPCR</h5>
                        <button type="button" wire:click="cancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('layouts.flash')
                        <div class="row">
                            <div class="mb-3">
                                <label for="actual_accomplishment" class="form-label">Actual Accomplishments</label>
                                <input wire:model="actual_accomplishment" type="text" id="actual_accomplishment"
                                    class="form-control @error('actual_accomplishment') is-invalid @enderror"
                                    placeholder="">
                                @error('actual_accomplishment')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="q1" class="form-label">Q1</label>
                                <input wire:model="q1" type="number" id="q1"
                                    class="form-control @error('q1') is-invalid @enderror"
                                    placeholder="5">
                                @error('q1')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="e2" class="form-label">E2</label>
                                <input wire:model="e2" type="number" id="e2"
                                    class="form-control @error('e2') is-invalid @enderror"
                                    placeholder="5">
                                @error('e2')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="t3" class="form-label">T3</label>
                                <input wire:model="t3" type="number" id="t3"
                                    class="form-control @error('t3') is-invalid @enderror"
                                    placeholder="5">
                                @error('t3')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="a4" class="form-label">A4</label>
                                <input wire:model="a4" type="number" id="a4"
                                    class="form-control @error('a4') is-invalid @enderror"
                                    placeholder="5">
                                @error('a4')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click="save" wire:loading.attr="disabled"
                            class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $user->name }} - {{ $user->designation }}</h2>
            <p>{{ $user->office->name }}</p>
        </div>

        <div class="col-md-12">
            @include('layouts.flash')
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

                        <div id="accordion{{ $key }}" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-response mt-3">
                                    <table class="table mb-3">
                                        <thead>
                                            <tr>
                                                <th>MFO/PAP</th>
                                                <th>Targets</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pcrs as $pcr)
                                                @if ($pcr->mfo_pap->target_function_id == $target_function->id)
                                                    
                                                    <tr>
                                                        <td width="40%">
                                                            {{ $pcr->mfo_pap->title }}
                                                        </td>

                                                        <td width="40%">
                                                            {{ $pcr->targets }} 
                                                            @include('components.status', [
                                                                'badgeColor' => $pcr::BADGE_COLOR[$pcr->status],
                                                                'status' => $pcr::STATUS[$pcr->status]
                                                            ])
                                                        </td>

                                                        <td width="20%">
                                                            <button wire:click.prevent="approve({{$pcr->id}})" title="Approve" type="button" class="btn rounded-pill btn-icon btn-outline-primary btn-sm">
                                                                <span class="tf-icons bx bx-like"></span>
                                                            </button>
                                                            <button wire:click.prevent="disapprove({{$pcr->id}})" title="Disapprove" type="button" class="btn rounded-pill btn-icon btn-outline-danger btn-sm">
                                                                <span class="tf-icons bx bx-dislike"></span>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

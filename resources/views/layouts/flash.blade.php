@if ($message = Session::get('success'))
<div class="alert alert-success border-primary" role="alert">
    <div class="container-md">
        <div class="row">
            <div class="col-12">

            <!-- Text -->
            <p class="text-center mb-0">
                {{ $message }}
            </p>

            </div>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert">
    <div class="container-md">
        <div class="row">
            <div class="col-12">

            <!-- Text -->
            <p class="text-center mb-0">
                {{ $message }}
            </p>

            </div>
        </div>
    </div>
</div>
@endif
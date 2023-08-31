@extends('layouts.app')

@section('content')
    <form action="{{ route('users.update', $user) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label" for="name">Name</label>
            <input type="text" 
            name="name"
            class="form-control @error('name') is-invalid @enderror" 
            id="name" 
            placeholder="John Doe"
            value="{{ $user->name }}">

            @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" 
            name="email"
            class="form-control @error('email') is-invalid @enderror" 
            id="email" 
            placeholder="john@example.com"
            value="{{ $user->email }}">

            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            

            <label class="form-label" for="roles">Role</label>
            @foreach ($roles as $key => $role)
                <div class="form-check">
                    <input name="roles[]" 
                    class="form-check-input @error('roles') is-invalid @enderror" 
                    type="checkbox" 
                    value="{{ $role['name'] }}" 
                    id="role{{$key}}"
                    @checked( in_array($role['name'], $user_roles) )>

                    <label class="form-check-label" for="role{{$key}}">
                        {{ $role['name'] }}
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
            <input type="password" 
            name="password"
            class="form-control @error('password') is-invalid @enderror" 
            id="password">

            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="password_confirmation">Password Confirmation</label>
            <input type="password" 
            name="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror" 
            id="password_confirmation">

            @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
           <button class="btn btn-primary">Update</button>
        </div>
        
    </form>
@endsection
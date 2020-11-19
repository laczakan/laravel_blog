@extends('layouts.template')

@section('title', 'Register')


@section('content')
    <h3>Register new user</h3>
    <br>
    <div class="jumbotron">
        <form method="POST" action="{{ url('/users') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" value="{{ old('password') }}"
                       class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
                       class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
@endsection

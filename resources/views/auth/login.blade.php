@extends('layouts.template')

@section('title', 'Login')


@section('content')
    <h3>Log in</h3>
    <br>
    <div class="jumbotron">
        <form method="POST" action="{{ url('/auth') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Password</label>
                <input id="password" name="password" type="password" value="{{ old('password') }}"
                       class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
@endsection

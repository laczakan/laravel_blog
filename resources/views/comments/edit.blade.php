@extends('layouts.template')

@section('title', 'Edit')

@section('header')
    @parent
@endsection

@section('content')

    <h3>Edit comment</h3>
    <div class="jumbotron">
        <form method="POST" action=" {{ url("comments/$comment->id") }}">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <label for="content">content:</label>
            </div>

            <input type="text" name="content" value="{{ old('content') ?? $comment->content }}"
                   class="form-control @error('content') is-invalid @enderror" id="content">
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    </div>
@endsection

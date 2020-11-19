@extends('layouts.template')

@section('title', 'Image')


@section('content')
    <h3>Change image</h3>
    <div class="jumbotron">
        <br>
        <form method="POST" enctype="multipart/form-data" action="{{ url('users/'.Auth::id().'/image')}}">
            @csrf
            <div class="form-group">
                <label for="image">Select image:</label>
                <input type="file" name="image" class=" @error('image') is-invalid @enderror" id="image">
                <div class="invalid-feedback">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }} </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

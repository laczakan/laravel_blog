@extends('layouts.template')

@section('title', 'Add category')


@section('content')
    <h3>Add category:</h3>
    <div class="jumbotron">
        <form method="POST" action="{{ url('category') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" value="{{ old('name') }}" type="text"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="custom-select @error('status') is-invalid @enderror" id="status">
                    <option value="" @if( old('status') == '') selected="selected" @endif>Choose...</option>
                    <option value="pending" @if( old('status') == 'pending') selected="selected" @endif>Pending</option>
                    <option value="active" @if( old('status') == 'active') selected="selected" @endif>Active</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection


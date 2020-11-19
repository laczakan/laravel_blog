@extends('layouts.template')

@section('title', 'Create article')

@section('header')
    @parent
@endsection

@section('content')
    <h3>Add new article</h3>
    <div class="jumbotron">
        <form method="POST" enctype="multipart/form-data" action="{{ url('articles') }}">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" name="title" value="{{ old('title') }}" type="text"
                       class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content"
                          class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="custom-select @error('category_id') is-invalid @enderror"
                        id="category_id">
                    <option value="" @if( old('category_id') == '') selected="selected" @endif>Choose category</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @if( old('category_id') == $category->id) selected="selected" @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" type="file" name="image" class="@error('image') is-invalid @enderror">
                @error('image')
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

            <button type="submit" class="btn btn-primary mt-4">Add article</button>

        </form>
    </div>
@endsection

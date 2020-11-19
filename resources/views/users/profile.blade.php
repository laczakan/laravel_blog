@extends('layouts.template')

@section('title', 'Profile')

@section('header')
    @parent
    <p>This is user header.</p>
@endsection

@section('content')
    @auth

        <div class="jumbotron mt-3">
            <div class="row">
                <div class="col-sm-8">
                    <h3>Hello {{Auth::user()->name}}</h3>
                    @if (Auth::user()->admin)
                        <span class="badge badge-danger m-3">admin</span>
                    @endif
                    @if (Auth::user()->mod)
                        <span class="badge badge-warning m-3">moderator</span>
                    @endif
                    <p>Email: {{Auth::user()->email}}</p>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <img src="{{ url('storage/upload/users/' . (Auth::user()->image ?? 'default.png')) }}"
                             class="img-thumbnail rounded-circle" width="200" height="200">
                    </div>
                    <div class="row">
                        <a href="{{ url('users/'. Auth::id() .'/image')}}" type="submit"
                           class="btn btn-sm btn-primary m-2"
                           title="Edit"> {{ Auth::user()->image ? 'Change image' : 'Add image' }}</a>

                        @if (Auth::user()->image)
                            <form method="POST" enctype="multipart/form-data"
                                  action="{{ url('users/'.Auth::id().'/delete') }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger m-2" title="Delete"
                                        onclick="return confirm('are you sure?')">Delete image
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

{{--        @auth('admin')--}}
                @if (Auth::user()->admin)
            <div class="row">
                <h3>Categories: </h3>
                <table class="table m-3">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        <th scope="col"><a href="{{ url('category/create') }}" type="submit"
                                           class="btn btn-primary float-right">Add category</a></th>
                    </tr>
                    </thead>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row"><span>{{ $category->id }}</span></th>
                            <td><span>{{ $category->name }}</span></td>
                            <td><span>{{ $category->title }}</span></td>
                            <td><span>{{ $category->status }}</span></td>
                            <td><span><a href="{{ url('category/'.$category->id.'/edit') }}" type="submit"
                                         class="btn btn-primary btn-small">Edit</a></span></td>
                        </tr>
                    @endforeach
                </table>
            </div>
                    @endif
{{--        @endauth--}}

        <div class="row">
            <h3>My articles: </h3>
            <table class="table m-3">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                @foreach ($articles as $article)
                    <tr>
                        <th scope="row"><span>{{$article->id}}</span></th>
                        <td><a href="{{ url('articles/' . $article->id) }}"
                               class="text-dark">{{ substr($article->title, 0, 120)}}...</a></td>
                        <td><span>{{ $article->status}}</span></td>
                        <td><a href="{{ url("articles/{$article->id}/edit/") }}" type="submit"
                               class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{$articles->links()}}
    @endauth
@endsection

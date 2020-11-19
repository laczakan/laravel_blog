@extends('layouts.template')

@section('title', 'Article Details')

@section('header')
    @parent
@endsection

@section('content')

    {{--    show article details as content section--}}
    <div class="jumbotron mt-3">
        @auth
            @can('update', $article)
                <a href="{{ url("articles/{$article->id}/edit/") }}" type="submit"
                   class="btn btn-primary ml-1 float-right">Edit article</a>
            @endcan
            @can('delete', $article)
                <form method="POST" enctype="multipart/form-data"
                      action="{{ url("articles/$article->id") }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger mr-1 float-right" title="Delete"
                            onclick="return confirm('are you sure?')">Delete article
                    </button>
                </form>
            @endcan


        @endauth
        <div class="row">
            <div class="col-sm-8 mb-3">
                <h1>{{$article->title}}</h1>
                <small class="">Created on {{$article->created_at}}
                    by <a
                        href="{{ url('users/'.$article->user_id.'/articles') }}">{{ $article->user->name }}</a></small>
                in <a href="{{ url('/category/'. $article->category->id) }}">{{ $article->category->title }}</a>
            </div>
            @if ($article->image)
                <div class="col-sm-4 mb-5">
                    <a href="{{ url('storage/upload/articles/' . ($article->image ?? 'null.jpeg')) }}"
                       data-toggle="lightbox"
                       data-gallery="img-gallery">
                        <img src="{{ url('storage/upload/articles/' . ($article->image ?? 'null.jpeg')) }}"
                             class="img-fluid img-thumbnail rounded">
                    </a>
                </div>
            @endif
            <br>
        </div>
        <p>{{$article->content}}</p>
    </div>

    {{--    show all comments --}}
    <h3>Comments:</h3>

    @if ($comments->count() >0)
        @foreach ($comments as $comment)
            <div class="media">
                <a href="{{ url("users/$comment->user_id/articles")}}">
                    <img src="{{ url('storage/upload/users/' . ($comment->user->image ?? 'null.png'))}}" class="mr-3"
                         alt="profile picture" width="64" height="64"></a>
                <div class="media-body alert alert-secondary">
                    <p>{{ $comment->content }}</p>
                    @if (!$comment->updated_at)
                        <p class="text-muted small ">Created at: {{ $comment->created_at}}</p>
                    @else
                        <p class="text-muted small ">Updated at: {{ $comment->updated_at }}</p>
                    @endif

                    {{--                if owner of comment show edit and delete--}}
                    @auth
                        @can('update', $comment)
                            <a title="Edit" href="{{ url("comments/$comment->id/edit") }}">
                                <button type="submit" class="btn btn-sm btn-outline-success m-1 float-right" title="Edit">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd"
                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                            </a>
                        @endcan

                        @can('delete', $comment)
                            <form method="POST" enctype="multipart/form-data"
                                  action="{{ url("comments/{$comment->id}") }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger m-1 float-right" title="Delete"
                                        onclick="return confirm('are you sure?')">
                                    <svg title="delete" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    @endauth
                </div>
            </div>

        @endforeach
    @endif



    {{--    add new comment if logged in --}}
    <div>
        @auth
            <form method="POST" action=" {{ url("articles/$article->id/comments") }}">

                @csrf
                <div class="form-group">
                    <label for="content">New comment:</label>
                </div>

                <input type="text" name="content" value="{{ old('content') }}"
                       class="form-control @error('content') is-invalid @enderror" id="content">
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary mt-3">Add comment</button>
            </form>
        @endauth

        {{--    if not logged show link--}}
        @guest
            <a class="mt-4" href="{{ url('auth/login')}}">Please login to add a comment</a>
        @endguest
    </div>

@endsection

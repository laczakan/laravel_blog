@extends('layouts.template')

@section('title', 'Articles')

@section('header')
    @parent
@endsection

@section('content')
    @if(count($articles) > 0)
        @foreach($articles as $article)
            <div class="jumbotron mt-3">
                <div class="row">
                    <div class="col-sm-9">
                        <h3><a href="/articles/{{$article->id}}"> {{$article->title}}</a></h3>
                        <small class="mb-5">Created at {{$article->created_at}}</small>
                    </div>
                    <div class="col-sm-3">
                        @if ($article->image)
                            <img src="{{ url('storage/upload/articles/' . $article->image) }}"
                                 class="img-thumbnail float-right" alt="image" width="300" height="300">
                        @else
                            <img src="{{ url('storage/upload/articles/null.jpeg') }}"
                                 class="img-thumbnail float-right" alt="image" width="300" height="300">
                        @endif
                    </div>
                </div>
                <br>
                <p>{{$article->content}}</p>
                <a class="btn btn-info btn-sm" href="/articles/{{ $article->id }}" role="button">More</a>
            </div>
        @endforeach
    @else
        <p>No articles found</p>
    @endif
    {{$articles->links()}}
@endsection

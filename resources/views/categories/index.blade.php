@extends('layouts.template')

@section('title', 'Categories articles')

@section('header')
    @parent
@endsection

@section('content')
    <h3><div class="text-center">{{ $category->title }} articles</div></h3>
    @foreach($articles as $article)
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-8 mb-3">
                    <h3><a href="/articles/{{$article->id}}"> {{$article->title}}</a></h3>
                    <p><small>Created at {{$article->created_at}}
                            by <a href="{{ url('users/'.$article->user_id.'/articles') }}">{{$article->user->name}}</a></small></p>
                </div>

                @if ($article->image)
                    <div class="col-sm-4 mb-5">
                        <a href="{{ url('storage/upload/articles/' . ($article->image ?? 'null.jpeg')) }}"
                           data-toggle="lightbox"
                           data-gallery="img-gallery">
                            <img src="{{ url('storage/upload/articles/' . ($article->image ?? 'null.jpeg')) }}"
                                 class="img-fluid img-thumbnail rounded"></a>
                    </div>
                @endif
            </div>
            <p>{{$article->content}}</p>
        </div>
    @endforeach
    {{$articles->links()}}
@endsection

@extends('layouts.app')

@section('title','标题')

@section('content')
<!-- Create article Form... -->

<!-- Current articles -->
<div class="ui fluid container">
    <div class="ui stackable grid">
        <div class="ui eleven wide column">
            @if (count($articles) > 0)
            @foreach ($articles as $article)
            <div class="ui items">
                <div class="item">
                    @if($article->thumbnail)
                    <a class="ui small image">
                        <img src="{{asset('uploads/'.$article->thumbnail)}}">
                    </a>
                    @endif
                    <div class="content">
                        <a href="/article/{{$article->id}}" class="header">{{ $article->title }}</a>
                        <div class="description">
                            {{ str_limit($article->content,200) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <p>
                {!! $articles->links() !!}
            </p>
            @endif
        </div>

        <div class="ui five width column">

        </div>
    </div>
</div>

@endsection

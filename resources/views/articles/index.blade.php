@extends('layouts.app')

@section('title','标题')

@section('content')
<!-- Create article Form... -->

<!-- Current articles -->
<div class="ui fluid container">
    <div class="ui stackable grid">
        <div class="ui eleven wide column">
            @if (count($articles) > 0)
            <div class="ui raised segments">
            @foreach ($articles as $article)
            <div class="ui items segment">
                <div class="item">
                    @if($article->thumbnail)
                    <a class="ui small image">
                        <img src="{{asset('uploads/'.$article->thumbnail)}}">
                    </a>
                    @endif
                    <div class="content">
                        <a href="/article/{{$article->id}}" class="ui blue header">{{ $article->title }}</a>
                        <div class="description">
                            {{ str_limit(strip_tags($article->content),200) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
            <div class="text_center">
                {!! $articles->links() !!}
            </div>
            @endif
        </div>

        <div class="ui five wide column">

            <div class="ui divided items">
                <div class="header">分类目录</div>
                <div class="meta">subtitle</div>
                    @foreach ( $categorys as $category )
                        @if ( $category->parent_id === 1 )
                        <div class="item">
                            <a href="/articles/category/{{$category->id}}/page/" class="item">{{ $category->name }}</a>
                        </div>
                            @foreach ( $categoryss as $category_ )
                                @if ($category_->parent_id === $category->id)
                                <div class="item">
                                    <a href="/articles/category/{{$category_->id}}/page/">
                                        <i class="fa fa-circle-o">  </i>{{ $category->name }} <i class="fa fa-chevron-circle-right"></i> {{$category_->name}}
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
            </div>

        </div>
    </div>
</div>

@endsection

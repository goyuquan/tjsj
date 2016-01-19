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
                        <a href="/article/{{$article->id}}" class="ui blue header">{{ $article->title }}</a>
                        <div class="description">
                            {{ str_limit(strip_tags($article->content),200) }}
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

        <div class="ui five wide column">
            <div class="ui card">
                <div class="content">
                    <div class="header">分类目录</div>
                    <div class="meta">好友</div>
                    <div class="ui list">
                        @foreach ( $categorys as $category )
                            @if ( $category->parent_id === 1 )
                                <a href="javascript:void(0);" class="item" name="{{$category->id}}">{{ $category->name }}</a>
                                @foreach ( $categoryss as $category_ )
                                    @if ($category_->parent_id === $category->id)
                                            <a href="javascript:void(0);" name="{{$category_->id}}">
                                                <i class="fa fa-circle-o">  </i>{{ $category->name }} <i class="fa fa-chevron-circle-right"></i> {{$category_->name}}
                                            </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('title',$article->title)

@section('content')

<div class="ui fluid container">

    <h1 class="ui header"> {{$article->title}}
        <div class="sub header">subtitle</div>
    </h1>

    <div class="ui stackable grid">
        <div class="eleven wide column">
                <h4 class="ui horizontal divider header"><i class="tag icon"></i> Description </h4>
                <div class="ui left floated image" style="width:300px;height:300px;background:#ccc;">
                    广告位
                </div>
                <p>
                    <?php echo(html_entity_decode($article->content, ENT_QUOTES, 'UTF-8')); ?>
                </p>

        </div>
        <div class="five wide column">

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

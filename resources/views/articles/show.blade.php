@extends('layouts.app')

@section('title',$article->title)

@section('content')

<div class="ui fluid container">

    <div class="ui stackable grid">
        <div class="eleven wide column">
                <h1 class="ui header"> {{$article->title}}
                    <div class="sub header">subtitle</div>
                </h1>
                <h4 class="ui horizontal divider header"><i class="tag icon"></i> Description </h4>
                <div class="ui left floated image" style="width:300px;height:300px;background:#ccc;">
                    广告位
                </div>
                <p>
                    <?php echo(html_entity_decode($article->content, ENT_QUOTES, 'UTF-8')); ?>
                </p>

        </div>
        <div class="five wide column">
            <div class="spaced">
                <button class="yellow ui button visible">Yellow</button>
                <button class="orange ui button">Orange</button>
                <button class="green ui button">Green</button>
                <button class="teal ui button">Teal</button>
                <button class="blue ui button">Blue</button>
                <button class="purple ui button">Purple</button>
                <button class="pink ui button">Pink</button>
                <button class="red ui button">Red</button>
                <button class="black ui button">Black</button>
            </div>
        </div>
    </div>

</div>

@endsection

@extends('admin.layouts.admin')

@section('style')
<style media="screen">
#media_body {
    min-height: 41px;
}
#wid-id-45 {
    padding:1em 0 0;
    margin-bottom: 0!important;
}
#wid-id-87 {
    margin-bottom: 1em;
}
#summernote2,#summernote2 div[role="content"] {
    padding: 0;
    margin-bottom: 0;
}
</style>
@endsection

@section('content')

@include('common.upload')
<!-- MAIN PANEL -->
<div id="main" role="main">


    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment">
            <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                <i class="fa fa-refresh"></i>
            </span>
        </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                控制台
            </li>
            <li>
                内容管理
            </li>
        </ol>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
    </span> -->

    </div>
<!-- END RIBBON -->

<!-- MAIN CONTENT -->
<div id="content">


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-pencil-square-o"></i> 内容管理 <span>> 编辑文章 </span>
            </h1>
        </div>
    </div>

    <!-- widget grid -->
    <section id="widget-grid">

        <!-- START ROW -->
        <div class="row">

            <!-- NEW COL START -->
            <article class="col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-87" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="true">

                    <!-- widget div-->
                    <div>

                        <div>

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <form id="edit_form" class="smart-form" novalidate="novalidate" method="POST" action="/admin/article/{{$article->id}}/update" enctype="multipart/form-data" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="thumbnail" value="{{ $article->thumbnail }}">
                                <input type="hidden" name="category" value="{{ $article->category_id }}">
                                <input type="hidden" name="display" value="{{ $article->display or " " }}">
                                <textarea id="input_content" class="hidden" name="content">{{ $article->content }}</textarea>
                                <textarea id="media_content" class="hidden" name="media">{{ $article->media }}</textarea>

                                        <fieldset>
                                            <!-- 标题 -->
                                            <section>
                                                <label class="input">
                                                    <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" name="title" value="{{ $article->title }}" placeholder="文章标题">
                                                </label>
                                                @if ($errors->has('title'))
                                                    <em for="title" class="invalid">{{ $errors->first('title') }}</em>
                                                @endif
                                            </section>
                                            <!-- 标题结束 -->

                                            <div class="row">
                                                <section class="col col-3">
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" name="published_at" placeholder="选择发布时间" class="datepicker" value="{{ $article->published_at }}" data-dateformat="yy-mm-dd">
                                                    </label>
                                                    @if ($errors->has('published_at'))
                                                    <em>{{ $errors->first('published_at') }}</em>
                                                    @endif
                                                </section>
                                                <div class="col col-1">
                                                    <a data-toggle="modal" href="#myModal" id="upload_bt0" class="btn btn-warning btn-sm"><i class="fa fa-upload"></i>     缩略图</a>
                                                </div>
                                                <section class="col col-8">
                                                    <div id="type_select" class="dropdown inline_block">
                                                        <a id="dLabel" role="button" name="{{App\Category::find($article->category_id)->id}}" data-toggle="dropdown" class="btn btn-primary btn-sm" data-target="#" href="javascript:void(0);">
                                                            <i class="fa fa-code-fork"></i>      {{ App\Category::find($article->category_id)->name}}
                                                            <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu multi-level" role="menu">
                                                            @foreach ( $categorys as $category )
                                                                @if ( $category->parent_id === 1 )
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="item" name="{{$category->id}}">{{ $category->name }}</a>
                                                                        @if ( !App\Category::where('parent_id',$category->id)->get()->isEmpty() )
                                                                            <ul class="dropdown-menu">
                                                                                @foreach ( $categoryss as $category_ )
                                                                                @if ($category_->parent_id === $category->id)
                                                                                <li>
                                                                                    <a href="javascript:void(0);" class="item" name="{{$category_->id}}">
                                                                                        {{$category_->name}}
                                                                                    </a>
                                                                                </li>
                                                                                @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif

                                                                    </li>
                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                    <div id="display_select" class="dropdown inline_block">
                                                        <a id="dLabel2" role="button" name="" data-toggle="dropdown" class="btn btn-primary btn-sm" data-target="#" href="javascript:void(0);">
                                                            <i class="fa fa-code-fork"></i>
                                                            <?php if ($article->display) {
                                                                echo App\Display::find( $article->display )->name;
                                                            } else {
                                                                echo "选择展示页面";
                                                            } ?>
                                                            <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu multi-level" role="menu">
                                                            @foreach ( $displays as $display )
                                                                @if ( $display->parent_id === 1 )
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="item" name="{{$display->id}}">{{ $display->name }}</a>
                                                                        @if ( !App\Display::where('parent_id',$display->id)->get()->isEmpty() )
                                                                            <ul class="dropdown-menu">
                                                                            @foreach ( $displayss as $display_ )
                                                                                @if ($display_->parent_id === $display->id)
                                                                                    <li>
                                                                                        <a href="javascript:void(0);" class="item" name="{{$display_->id}}">
                                                                                            {{$display_->name}}
                                                                                        </a>
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </section>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label>标签 (多选)</label>
                                                <select multiple style="width:100%" class="select2">
                                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                                        <option value="AK">Alaska</option>
                                                        <option value="HI">Hawaii</option>
                                                    </optgroup>
                                                    <optgroup label="Pacific Time Zone">
                                                        <option value="CA">California</option>
                                                        <option value="NV" selected="selected">Nevada</option>
                                                        <option value="OR">Oregon</option>
                                                        <option value="WA">Washington</option>
                                                    </optgroup>
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT" selected="selected">Montana</option><option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                    <optgroup label="Eastern Time Zone">
                                                        <option value="CT">Connecticut</option>
                                                        <option value="DE">Delaware</option>
                                                        <option value="FL">Florida</option>
                                                        <option value="GA">Georgia</option>
                                                        <option value="IN">Indiana</option>
                                                        <option value="ME">Maine</option>
                                                        <option value="MD">Maryland</option>
                                                        <option value="MA">Massachusetts</option>
                                                        <option value="MI" selected="selected">Michigan</option>
                                                        <option value="NH">New Hampshire</option>
                                                        <option value="NJ">New Jersey</option>
                                                        <option value="NY">New York</option>
                                                        <option value="NC">North Carolina</option>
                                                        <option value="OH">Ohio</option>
                                                        <option value="PA">Pennsylvania</option>
                                                        <option value="RI">Rhode Island</option>
                                                        <option value="SC">South Carolina</option>
                                                        <option value="VT">Vermont</option>
                                                        <option value="VA">Virginia</option>
                                                        <option value="WV">West Virginia</option>
                                                    </optgroup>
                                                </select>

                                                <div class="note">
                                                    <strong>提示:</strong> 按住<strong>Ctrl</strong>键多选。
                                                </div>
                                            </div> -->
                                        </fieldset>

                                </div>
                                <!-- end widget content -->
                            </div>
                            <!-- end widget div -->
                        </div>
                        <!-- end widget -->
                        <div class="jarviswidget well transparent" id="wid-id-45" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                <!-- widget content -->
                                <div id="media_body" class="widget-body">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a id="media_bt" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        插入媒体、表格、图表
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body" style="padding:0;">
                                                    <div class="jarviswidget jarviswidget-color-blue" id="summernote2" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-collapsed="false" data-widget-sortable="false">
                                                        <!-- widget div-->
                                                        <div>
                                                            <!-- widget edit box -->
                                                            <div class="jarviswidget-editbox"> </div>
                                                            <div class="widget-body no-padding">

                                                                <div class="web_area">
                                                                    <?php echo(html_entity_decode($article->media, ENT_QUOTES, 'UTF-8')); ?>
                                                                 </div>

                                                            </div>
                                                            <!-- end widget content -->

                                                        </div>
                                                        <!-- end widget div -->

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>


                        <div class="jarviswidget jarviswidget-color-blue" id="summernote" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-collapsed="false" data-widget-sortable="false">
            				<header>
            					<span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
            					<h2>网页内容编辑器</h2>

            				</header>

            				<!-- widget div-->
            				<div>

            					<!-- widget edit box -->
            					<div class="jarviswidget-editbox">
            						<!-- This area used as dropdown edit box -->

            					</div>
            					<!-- end widget edit box -->

            					<!-- widget content -->
            					<div class="widget-body no-padding">

            						<div class="web_area">
                                        <?php echo(html_entity_decode($article->content, ENT_QUOTES, 'UTF-8')); ?>
            						</div>

            						<div class="widget-footer smart-form">

                                    <div class="btn-group">
                                        <button id="summernote_save" class="btn btn-sm btn-success" type="button">
                                            <i class="fa fa-check"></i> 保存
                                        </button>
                                    </div>
            						<div class="btn-group">
            							<button id="summernote_clear" class="btn btn-sm btn-primary" type="button">
            								<i class="fa fa-times"></i> 清空
            							</button>
            						</div>

            						</div>

            					</div>
            					<!-- end widget content -->

            				</div>
            				<!-- end widget div -->

            			</div>

                        <!-- <div class="jarviswidget jarviswidget-color-blue" id="markdown" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="true">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                                <h2>文本内容编辑器</h2>
                            </header>
                            <div>
                                <div class="jarviswidget-editbox">
                                </div>
                                <div class="widget-body no-padding">
                                    <textarea id="text_area" name="content" class="custom-scroll" style="max-height:180px;"> {{ old('content') }} </textarea>
                                    @if ($errors->has('content'))
                                    <strong>{{ $errors->first('content') }}</strong>
                                    @endif
                                </div>
                            </div>
                        </div> -->


                    </article>
                    <!-- END COL -->

        </div>

        <!-- END ROW -->

    </section>
    <!-- end widget grid -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="submit" id="submit2" class="btn btn-primary btn-lg btn-block" value="提交     submit">


    </form>

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->




@endsection

@section('script')
<script src="/js/upload.js"></script>
<script src="/js/plugin/summernote/summernote.js"></script>
<script src="/js/plugin/markdown/markdown.min.js"></script>
<script src="/js/plugin/markdown/to-markdown.min.js"></script>
<script src="/js/plugin/markdown/bootstrap-markdown.min.js"></script>
<script src="/js/plugin/jquery-form/jquery-form.min.js"></script>

<script>
$(function(){

    $("#aside_article").addClass("open");
    $("#aside_article_").show();
    $("#aside_article_add").addClass("active");

    $("#text_area").markdown({
        autofocus:false,
        savable:false
    });

    $('.web_area').summernote({
		height : 280,
		focus : false,
		tabsize : 2
	});

    $("#summernote textarea").attr("name","content");
    $('#summernote #summernote_save').addClass("disabled");
    $('#summernote #summernote_clear').addClass("disabled");
    $("#category_bt").text($("input[name='category']").val());


    $(".note-editable").keyup(function(){
        if ($(this).html() != "") {
            $("#summernote").removeClass("jarviswidget-color-greenDark jarviswidget-color-redLight").addClass("jarviswidget-color-blue");
            $('#summernote #summernote_save').removeClass("disabled");
            $('#summernote #summernote_clear').removeClass("disabled");
        } else {
            $('#summernote #summernote_save').addClass("disabled");
            $('#summernote #summernote_clear').addClass("disabled");
        }
    });

    $(".note-editable").bind('DOMNodeInserted', function () {
        if ($(this).html() != "") {
            $("#summernote").removeClass("jarviswidget-color-greenDark jarviswidget-color-redLight").addClass("jarviswidget-color-blue");
            $('#summernote #summernote_save').removeClass("disabled");
            $('#summernote #summernote_clear').removeClass("disabled");
        } else {
            $('#summernote #summernote_save').addClass("disabled");
            $('#summernote #summernote_clear').addClass("disabled");
        }
    });

    $('#summernote #summernote_save').click(function(){
        $("#summernote").removeClass("jarviswidget-color-blue").addClass("jarviswidget-color-greenDark");
        $("#input_content").val($("#summernote .note-editable").html());
        $('#summernote #summernote_save').addClass("disabled");
        $('#summernote #summernote_clear').addClass("disabled");
    });

    $('#summernote #summernote_clear').click(function(){
        $("#input_content").empty();
        $(".note-editable").empty();
        $('#summernote #summernote_save').addClass("disabled");
        $(this).addClass("disabled");
    });

    // 分类点击赋值
    $("#type_select ul a:not('.parent-item')").click(function(){
        $("input[name='category']").val($(this).attr("name"));
        $("#dLabel").html("<i class='fa fa-gear'></i>   "+$(this).text()+"   <span class='caret'></span>");
    });

    // 显示页面设置
    $("#display_select ul a:not('.parent-item')").click(function(){
        $("input[name='display']").val($(this).attr("name"));
        $("#dLabel2").html("<i class='fa fa-gear'></i>   "+$(this).text()+"   <span class='caret'></span>");
    });

    //media收起保存
    $("#media_bt").click(function(){
        if (!$(this).hasClass("collapsed")) {
            $("#media_content").val($("#summernote2 .note-editable").html());
        }
    });

    $(".dropdown-menu").parent("li").addClass("dropdown-submenu");//给分类列表父元素加dropdown-submenu类

    var $creat_form = $("#edit_form").validate({
		// Rules for form validation
		rules : {
			title : {
				required : true,
				minlength : 5,
				maxlength : 200
			},
			category : {
				required : true,
			}
		},

		// Messages for form validation
		messages : {
			title : {
				required : '请输入标题',
                minlength : '不能小于5位',
                maxlength : '不能大于200位',
			},
			category : {
				required : '请选择分类'
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});

    $("#edit_form").submit(function(){
        if ($("#input_content").val() == "") {
            $("#summernote").removeClass("jarviswidget-color-blue").addClass("jarviswidget-color-redLight");
            $("#summernote h2").text("内容不能为空");
            return false;
        }
    });


});
</script>

@endsection

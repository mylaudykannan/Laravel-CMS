@extends('admin.layouts.app')
@push('stylesheets')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}"> --}}
@endpush

@section('content')

<div class="container-fluid">
    @include('Gallery::admin.inc.alert')
    <div class="row">

        <div class="col-12">
            <form action="{{ URL('admin/page/store') }}" method="post" id="pageform">
                @csrf
                <div class="card customCard mt-4 mb-5">
                    <!-- Card header -->
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h5 class="text-white text-capitalize pl-3 mb-0">Add New Page</h5>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="form-group">
                            @include('Gallery::admin.inc.mediainput',['name'=>'image','class' => 'required','attr' =>
                            'data-empty=Select&nbsp;Image','sizemessage'=>'600 x 400','showalt'=>true])
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control required" id="title" placeholder="Enter Title"
                                name="title" data-empty="Enter Title" data-max="250"
                                data-lengtherr="Maximum 250 characters allowed" />
                        </div>
                        <div class="form-group hidden">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" placeholder="Enter Content"
                                data-empty="Enter Content" ></textarea>
                            {{-- <textarea class="form-control" id="content" name="content" placeholder="Enter Content"
                                data-empty="Enter Content" data-allowed="page"></textarea> --}}
                        </div>
                        <div class="form-group hidden">
                            <label for="title">Category</label>
                            <br>
                            @foreach($pagecategory as $nkey => $nval)
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value="{{$nval['title']}}"
                                        name="category[]">{{$nval['title']}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="title">Status</label>
                            <select class="form-control required" data-empty="Select Status" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="1" selected>Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Publish Date</label>
                            <input type="text" readonly class="form-control flatpicker required" id="publish_on"
                                placeholder="Enter Publish Date" name="publish_on" data-empty="Enter Publish Date"
                                flat-config="current" />
                        </div>
                    </div>
                </div>
                
                <hr>
                @if(!empty($page) && config('page.section.'.$page['pointslug']))
                @foreach(config('page.section.'.$page['pointslug']) as $k => $v)
                <div class="card customCard transparent">

                    <div class="card-body pt-2">



                        <div class="">
                            <div class="row clearfix">
                                <div class="col-md-12 table-responsive">
                                    <table id="tab_logic{{$k}}" class="table table-bordered table-hover table-sortable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{$v['title']}}</th>
                                                @if(!config('page.section.'.$page['pointslug'].'.'.$k.'.static'))
                                                <th class="text-center"
                                                    style="border-top: 1px solid rgb(255, 255, 255); border-right: 1px solid rgb(255, 255, 255);width:100px;">
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="{{$k}}addr0" data-id="0"
                                                class="@if(!config('page.section.'.$page['pointslug'].'.'.$k.'.static')) hidden novalidation @endif ">
                                                <td data-name="stitle">
                                                    @if(isset($v['blade']))
                                                    @include('Page::admin.section.'.$v['blade'],['k'=>$k,'firstrow'=>true])
                                                    @else
                                                    @include('Page::admin.section.fields',['k'=>$k,'firstrow'=>true])
                                                    @endif
                                                </td>
                                                @if(!config('page.section.'.$page['pointslug'].'.'.$k.'.static'))
                                                <td data-name="del"><button name="{{$k}}del0"
                                                        class="btn btn-danger row-remove"><i
                                                            class="far fa-trash-alt"></i></button>
                                                    <span class="moveupbtn" title="Move Up"><i
                                                            class="fas fa-arrow-alt-circle-up"></i></span>
                                                    <span class="movedownbtn" title="Move Down"><i
                                                            class="fas fa-arrow-alt-circle-down"></i></span>
                                                </td>
                                                @endif
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if(!config('page.section.'.$page['pointslug'].'.'.$k.'.static'))
                            <a id="add_row{{$k}}" class="btn btn-primary pull-left text-white add_row"
                                data-section="{{$k}}">Add Row</a><input type="hidden" name="loopcount{{$k}}" value="0"
                                id="loopcount{{$k}}">
                            @endif

                        </div>
                    </div>


                </div>
                <hr>
                @endforeach
                @endif
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <a href="{{URL()->previous()}}" class="btn btn-default">Back</a>
                    </div>
                    <div class="col-12 col-sm-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" id="draftsubmitbtn">Save as Draft</button>
                        <button type="submit" class="btn btn-success ml-3"
                            onclick="if(validation(event,'#pageform')==true) $('#pageform').submit();">Publish</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@include('Gallery::admin.inc.gallerymodal')
@endsection
@push('scripts')
@include('admin.inc.addsectionscript')
@include('admin.inc.tinyscript')
<script>
    var root = $('#rootfolder').val();
    $('body').on('click','#draftsubmitbtn',function(e){
        e.preventDefault();
        var _this = $(this);
        _this.prop('disabled', true);
        var result = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: root + '/admin/draftpage/store?frompage=1',
            type: "POST",
            datatype: "json",
            data: new FormData($('#pageform')[0]),
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(data) {
                _this.prop('disabled', false);
                window.location.href = data.redirect;
            },
            error: function(xhr, status, error) {
                _this.prop('disabled', false);
                var result = eval("(" + xhr.responseText + ")");
                $.each(result.errors, function(key, value) {
                    var keyname = key;
                    key = key.replace(".", "");
                    var id = "#" + key + "-error";
                    var error_lable = '<label id="' + key + '-error" class="error" for="' + key + '" style="">'+ value +'</label>';
                    $('[name="' + keyname + '"]').after(error_lable);
                });                
                return true;
            }
        });    
    });
    $(document).ready(function(){
        $('#add_rowcontent').click();
    });
</script>
@include('Gallery::admin.inc.mediascript',['name'=>'image'])
@endpush
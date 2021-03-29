<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List of files<small>Files</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                   List of your files that uploaded
                </p>
                <div class="col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>File Details  <small>After uploaded file the details will be displayed here </small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <a class="btn btn-success btn-lg center-block" href="{{url('file/download',[$file->unique_code])}}"> Download - {{$file->name}} </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>File Details  <small>After uploaded file the details will be displayed here </small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p>Page Link: <span id="file-link"> <a target="_blank" href="{{url('/',[$file->unique_code])}}"> {{url('/',[$file->unique_code])}} </a>  </span></p>
                            <p>File Link: <span id="file-link"> <a target="_blank" href="{{url('/file/download',[$file->unique_code])}}"> {{url('/file/download',[$file->unique_code])}} </a>  </span></p>
                            <p>Name: <span id="file-name"> {{$file->name}} </span></p>
                            <p>Type: <span id="file-type"> {{$file->type}} </span></p>
                            <p>Size: <span id="file-size"> {{number_format($file->size/1024/1024,2)}} MB </span></p>
                            <p>Downloaded: <span id="file-size"> {{$file->download_count}}  </span></p>
                            <p>date of upload: <span id="file-size"> {{$file->created_at}}  </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input name="csrf-token" type="hidden" value="{{csrf_token()}}">
@include('templates.gentelella.back-end.layouts.modal')
<script>
    function deleteFile(fileID)
    {
        var postRequest=postRequestDirectly('file/delete',{"id":fileID},true);
        postRequest.done(function(jsonData){

          if(jsonData.status)
          {
              showModal();
              showModalMessage('success','File has been deleted');
              doThis('hide','#'+fileID);
          }
        })
    }
</script>
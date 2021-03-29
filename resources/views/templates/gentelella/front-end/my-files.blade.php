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
                    List of uploaded files
                </p>

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>File name</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Uploaded at</th>
                        <th>Downloaded</th>
                        <th>Link</th>
                        <th>settings</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($myFiles))
                        @foreach($myFiles as $file)
                        <tr id="{{$file->id}}">
                            <td>{{$file->name}}</td>
                            <td>{{number_format($file->size / 1024 / 1024,2)}} MB</td>
                            <td>{{$file->type}}</td>
                            <td>{{$file->created_at}}</td>
                            <td>{{$file->download_count}}</td>
                            <td><a target="_blank" href="{{url('/',[$file->unique_code])}}"> {{url('/',[$file->unique_code])}}</a></td>
                            <td> <a onclick="deleteFile({{$file->id}})" class="btn btn-danger btn-block"> <span class="fa fa-remove"></span></a> </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Upload form <small> </small></h2>
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
                <form action="{{url('file/uploader')}}" id="myForm" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="file" class="btn btn-upload" name="file">  <br>

                    <div class="progress">
                        <div class="progress-bar-blue progress-bar-striped active" role="progressbar"
                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span id="percent">0%</span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Upload">
                </form>
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
                <p>File Link: <span id="file-link">  </span></p>
                <p>Name: <span id="file-name">  </span></p>
                <p>Type: <span id="file-type">  </span></p>
                <p>Size: <span id="file-size"> </span></p>
            </div>
        </div>
    </div>
</div>
@include('templates.gentelella.back-end.layouts.modal')
<script src="{{asset('scripts/jquery-form/jquery.js')}}"></script>
<script src="{{asset('scripts/jquery-form/jquery.form.js')}}"></script>
<script type="text/javascript">

    var bar = $('.progress-bar-blue');
    var percent = $('#percent');

    $('form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
            console.log(percentVal, position, total);
        },
        success: function() {
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        complete: function(xhr) {
            jsonData=JSON.parse(xhr.responseText);

            console.log(jsonData);


            if(!jsonData.status)
            {
                showError(jsonData);
            }else{
                percent.html('File upload completed successfully');
                importHtml('#file-link',"<a href='"+jsonData.data.link+"'>"+jsonData.data.link+"</a>");
                importHtml('#file-name',jsonData.data.name);
                importHtml('#file-type',jsonData.data.type);
                importHtml('#file-size',jsonData.data.size);
            }
        }
    });
</script>
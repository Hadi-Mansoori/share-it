@if(isset(Auth::user()->id))
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
   <div class="menu_section">
        <h3>{{__('admin.menu')}}</h3>
        <ul class="nav side-menu">
            <li><a href="{{url('admin/panel')}}"><i class="fa fa-dashboard"></i> {{__('admin.dashboard')}} </a></li>
            <li><a href="{{url('file/uploader')}}"><i class="fa fa-upload"></i> {{__('admin.upload')}} </a></li>
            <li><a href="{{url('file/my-files')}}"><i class="fa fa-list"></i> {{__('admin.myfile')}} </a></li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->
<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('user/logout')}}">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
    @else
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>Menus</h3>
            <ul class="nav side-menu">
                <li><a href="{{url('/')}}"><i class="fa fa-sign-in"></i> Login </a></li>
            </ul>
        </div>

    </div>
@endif
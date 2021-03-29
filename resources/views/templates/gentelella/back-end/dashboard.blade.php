@extends('templates.gentelella.back-end.layouts.header')

@section('content')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                   
                    <a href="{{url('/')}}" class="site_title"><i class="fa fa-share-alt"></i> <span>{{config('app.name')}}</span></a>
                </div>

                <div class="clearfix"></div>

            @include('templates.gentelella.back-end.profile-quick-info')

            @include('templates.gentelella.back-end.menus')


            </div>
        </div>

        @include('templates.gentelella.back-end.top-navigation')

        <!-- page content -->
        <div class="right_col" role="main">
            {!! $view !!}
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Upkey - share it project <a href="https://upkey.com">Upkey.com - Programmer Hadi Mansoori</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
@include('templates.gentelella.back-end.layouts.script')
@stop

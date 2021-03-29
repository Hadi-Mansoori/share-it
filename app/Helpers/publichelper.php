<?php

use Illuminate\Support\Facades\Auth;

function loadView($template, $data)
{
    return view($template.'back-end/dashboard',$data);
}

function getUserFullName()
{
    if(isset(Auth::user()->id))
    {
        $user['first_name']=Auth::user()->first_name;
        $user['last_name']=Auth::user()->last_name;
    }else
    {
        $user['first_name']='Guest';
        $user['last_name']=null;
    }
    return $user;
}
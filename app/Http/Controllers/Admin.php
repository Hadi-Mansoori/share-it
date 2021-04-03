<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{

    /*
     * Written by Sayed hadi masnoori rad
     * email: eh.mansoori@gmail.com
     *
     * Get the template name from "config/app" path and selects it as the default template
     */
    function __construct()
    {
        $this->template=config('app.template-name');
    }

    /**
     *
     * load dashboard - loadView is a helper that located in the "app/Helpers" directory
     *
     * written by sayed hadi mansoori rad
     * email: eh.mansoori@gmail.com
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function panel()
    {
        $view=view($this->template.'back-end/dashboard-content')->render();
        return view($this->template.'back-end/dashboard',['view'=>$view]);
    }
}

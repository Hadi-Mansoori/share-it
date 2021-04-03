<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    /*
     * Using app.template you can change admin or front end template
     * All result of this class after processing sends json data and handled by javascript in front end
     *
     *
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
     * written by sayed hadi mansoori rad
     * email: eh.mansoori@gmail.com
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login()
    {
        $request=\Request::all();

        if(!empty($request))
        {
            $validator = \Validator::make($request,
                [
                    'name' => 'required',
                    'password' => 'required|min:8',
                ],
                [
                    'name.required'=>__('user.name'),
                    'password.required'=>__('user.password'),
                    'password.min'=>__('user.password-min'),

                ]
            );

            $messages= $validator->messages();
            if($validator->failed())
            {
                return response()->json([
                    'status' => false,
                    'data' => $messages,
                    'code' => 2,
                ]);
            }

            $user=\App\User::where('name',$request['name'])->first();

            if(!empty($user))
            {
                if (Hash::check($request['password'], $user->password))
                {
                    // Successful login
                    Auth::login($user);
                    return response()->json([
                        'status' => true,
                        'data' => ['message'=>__('user.user-password-incorrect')],
                        'code' => 1,
                    ]);
                }else
                {
                    // when password is incorrect
                    return response()->json([
                        'status' => false,
                        'data' => ['message'=>__('user.user-password-incorrect')],
                        'code' => 2
                    ]);
                }
            }else
            {
                // when the user is wrong
                return response()->json([
                    'status' => false,
                    'data' => ['message'=>__('user.user-password-incorrect')],
                    'code' => 2
                ]);
            }

        }else{

            if(isset(Auth::user()->id))  return redirect('admin/panel');
            return view($this->template.'front-end/login-signup');
        }
    }

    /**
     *
     * Register method
     *
     *
     * written by sayed hadi mansoori rad
     * email: eh.mansoori@gmail.com
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $request=\Request::all();



        if(!empty($request)) {
            $validator = \Validator::make($request,
                [
                    'name' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|required_with:password|same:password|min:8',
                ],
                [
                    'name.required' => __('user.register-name'),
                    'first_name.required' => __('register-first_name'),
                    'last_name.required' => __('register-last_name'),
                    'email.required' => __('user.register-email'),
                    'password.required' => __('user.register-password'),
                    'confirm_password.same' => __('user.register-confirm-password-same'),
                    'confirm_password.min' => __('user.register-confirm-password-min'),
                    'password.min' => __('user.password-min'),
                    'email.email' => __('user.register-email'),
                ]
            );

            $messages = $validator->messages();

            if ($validator->failed()) {
                return response()->json([
                    'status' => false,
                    'data' => $messages,
                    'code' => 2,
                ]);
            }

            $request['password']=bcrypt($request['password']);

            try{
                $user=\App\User::create($request);
                Auth::login($user);

                if($user)
                {
                    return response()->json([
                        'status' => true,
                        'data' => ['message'=>__('user.register-success')],
                        'code' => 1,
                    ]);
                }

            }catch (\Exception $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode==1062)
                {
                    return response()->json([
                        'status' => false,
                        'data' => ['error'=>__('user.duplicate-data')],
                        'code' => $errorCode,
                    ]);
                }

                if($errorCode==1364)
                {
                    return response()->json([
                        'status' => false,
                        'data' => ['error'=>$e->getMessage()],
                        'code' => $errorCode,
                    ]);
                }


            }
        }
    }


    /**
     * Logout method
     *
     * written by sayed hadi mansoori rad
     * email: eh.mansoori@gmail.com
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        if(isset(Auth::user()->id))
        {
            Auth::logout();
            return redirect('/');
        }else return redirect('/');
    }
}
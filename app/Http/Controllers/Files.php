<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as laravelFile;
use Illuminate\Support\Str;

class Files extends Controller
{
    /*
     *
     * All method of this class send json data and handled by javascript language from front end
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
     * Getting the file from form and uploaded in the "storage/uploads/files/userid/filename"
     *
     * written by sayed hadi mansooi rad
     * email: eh.mansoori@gmail.com
     *
     * @return view and json data
     * @throws \Throwable
     */
    public function uploader()
    {
        ini_set('max_execution_time', 0);
        set_time_limit(0);

        $request = \Request::all();
        $file=\Request::file('file');
        if (!empty($request))
        {
            $validator = \Validator::make($request,
                ['file' => 'mimes:jpg,png,gif,jpeg,mp4,pdf|max:10240|required']
            );

            $messages = $validator->messages();

            if ($validator->failed()) {
                return response()->json([
                    'status' => false,
                    'data' => $messages,
                    'code' => 2,
                ]);
            }

            $destinationPath = config('app.upload-path').Auth::user()->id.'/';
            $standardName=time().'-'.Str::random(9).'-'.Auth::user()->id.'.'.$file->getClientOriginalExtension();
            $fileDetails=[
                'size'=>$file->getSize(),
                'type'=>$file->getClientOriginalExtension(),
                'path'=>$destinationPath.'/'.$standardName,
                'name'=>$file->getClientOriginalName(),
                'standard_name'=>$standardName,
                'user_id'=>Auth::user()->id,
                'unique_code'=>Str::random(9).Auth::user()->id
            ];

            try{

                $fileRecord=File::create($fileDetails);
                $fileDetails['unique_code'].=$fileRecord->id;
                File::where('id',$fileRecord->id)->update($fileDetails);
                $file->move($destinationPath,$fileDetails['standard_name']);
                $fileDetails['link']= url('/',[$fileDetails['unique_code']]);

                return response()->json([
                    'status' => true,
                    'data' => $fileDetails,
                    'code' => 1,
                ]);

            }catch (\Exception $e)
            {
                $errorCode = $e->errorInfo[1];

                return response()->json([
                    'status' => false,
                    'data' =>  [$e->getMessage()],
                    'code' => $errorCode,
                ]);

            }

        }else{
            $view=view($this->template.'front-end/uploader-form')->render();
            return view($this->template.'back-end/dashboard',['view'=>$view]);
        }
    }

    /**
     *
     * getting and view lists of files.
     *
     * written by sayed hadi mansoori rad
     * eh.mansoori@gmail.com
     *
     * @return json data
     * @throws \Throwable
     */
    public function myFiles()
    {
        $files=File::where('user_id',Auth::user()->id)->get();
        $view=view($this->template.'front-end/my-files',['myFiles'=>$files])->render();
        return view($this->template.'back-end/dashboard',['view'=>$view]);
    }

    /**
     *
     * Delete file by file id and user id  (method post is used)
     *
     * written by sayed hadi mansoori rad
     * email: eh.mansoori@gmail.com
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile()
    {
        $request=\Request::all();
        if(is_numeric($request['id'])) $fileID=$request['id'];
        else{
            return response()->json([
                'status' => false,
                'data' => ['message'=>$request['id'].__('file.file-id-error')],
                'code' => 2,
            ]);
        }

        $file=File::find($request['id']);

        try{
            if(file_exists($file->path)) laravelFile::delete($file->path);
            File::where('id',$fileID)->where('user_id',Auth::user()->id)->delete();
            return response()->json([
                'status' => true,
                'data' => ['message'=>__('file.delete-success')],
                'code' => 1,
            ]);

        }catch (\Exception $e)
        {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => false,
                'data' => ['message'=>$e->getMessage()],
                'code' => $errorCode,
            ]);
        }
    }

    /**
     *
     * display file page and shows all details of file and also everyone can download file without authorized
     *
     * @param $uniqueCode
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @throws \Throwable
     */
    public function downloadPage($uniqueCode)
    {
        if($uniqueCode=='login') return redirect('user/login');
        try{
            $file=File::where('unique_code',$uniqueCode)->first();
            $view=view($this->template.'front-end/download-page',['file'=>$file])->render();
            return view($this->template.'back-end/dashboard',['view'=>$view]);

        }catch (\Exception $e)
        {
            return abort('404');
        }
    }

    /**
     *
     * Download file by unique code of file
     *
     *
     * written by sayed hadi mansoori rad
     * email : eh.mansoori@gmail.com
     *
     * @param $uniqueCode
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($uniqueCode)
    {
        ob_end_clean();
        try{
            $file=File::where('unique_code',$uniqueCode)->first();
            $fileDetails['download_count']=$file->download_count=$file->download_count+1;
            File::where('id',$file->id)->update($fileDetails);

            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            return response()->download($file->path);
        }catch (\Exception $e)
        {
            return response()->json([
                'status' => false,
                'data' => ['error'=>$e->getMessage()],
                'code' => $e->getCode(),
            ]);
        }
    }
}
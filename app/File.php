<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name', 'size', 'type','path','download_count','user_id','standard_name'
    ];

    /*protected $guarded = array('id', 'random_column');
    protected $table='files';*/

}

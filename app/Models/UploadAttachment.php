<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAttachment extends Model
{
    use HasFactory;


    protected $fillable = ['filename', 'path', 'mime_type', 'upload_id'];

    public function upload()
    {
        return $this->belongsTo('App\Upload');
    }
}

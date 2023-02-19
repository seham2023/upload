<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\traits\UploadTrait;
use App\Models\Upload;
use App\Models\UploadAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UploadController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploads=Upload::all();

        return view('upload.index',compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('upload.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $upload = Upload::create([
            'title' => $request->title,
            'description' => $request->description,
            'profile' => 'default',
            'gallery' => 'default'
        ]);

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $name = time() . '.' . $profile->getClientOriginalName();
            $this->uploadFile($profile, 'uploads', 'myuploads', $name, null);
            $upload->profile = $name;
        }

        if ($request->hasFile('gallery') && count($request->file('gallery')) > 1) {
            $galleries = $request->file('gallery');
            foreach ($galleries as $galleryFile) {
                $name = time() . '.' .$galleryFile->getClientOriginalName();

                $attachment = new UploadAttachment();
                $attachment->filename = $galleryFile->getClientOriginalName();
                $attachment->path =  $name;
                $attachment->upload_id = $upload->id;
                $attachment->save();
            }
        } elseif ($request->hasFile('gallery')) {
            $galleries = $request->file('gallery');
            $name = time() . '.' . $galleries[0]->getClientOriginalName();
            $this->uploadFile($galleries[0], 'uploads', 'myuploads', $name, null);
            $upload->gallery = $name;
        }

        $upload->save();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $upload=Upload::findorfail($id);
        return view('upload.edit',compact('upload'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $upload=Upload::findorfail($request->id);
        $data=[  'title' => $request->title,
        'description' => $request->description,];
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $name = time() . '.' . $profile->getClientOriginalName();
            $this->uploadFile($profile, 'uploads', 'myuploads', $name, null);
            $data['profile'] = $name;
        }
        if ($request->hasFile('gallery') && count($request->file('gallery')) > 1) {
            UploadAttachment::where('upload_id',$upload->id)->delete();
            $galleries = $request->file('gallery');
            foreach ($galleries as $galleryFile) {
                $name = time() . '.' .$galleryFile->getClientOriginalName();

                $attachment = new UploadAttachment();
                $attachment->filename = $galleryFile->getClientOriginalName();
                $attachment->path =  $name;
                $attachment->upload_id = $upload->id;
                $attachment->save();
            }
        } elseif ($request->hasFile('gallery')) {
            $galleries = $request->file('gallery');
            $name = time() . '.' . $galleries[0]->getClientOriginalName();
            $this->uploadFile($galleries[0], 'uploads', 'myuploads', $name, null);
            $data['gallery'] = $name;
        }
        $upload->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Enums\PrivacyEnum;
use App\Models\Permession;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();

        $blogCapabilities = PrivacyEnum::getCapabilities(PrivacyEnum::Blog);
        // return $blogCapabilities;
        return view('permissions.create', compact('blogCapabilities','roles'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // return $request;
            Permission::create([
                'role_id'=>$request->role_id,

                'privacy'=>$request->privacy,
                'capabilities'=>$request->permissions,

            ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}

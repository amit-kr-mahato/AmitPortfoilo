<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
 {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
 {
        $setting = Setting::first();

        return view( 'admin.setting.index', compact( 'setting' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\Admin\SettingRequest  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( SettingRequest $request, Setting $setting )
 {
        $validated = $request->validated();

        // ===  ===  ===  ===  ===  ===  ===  =
        // ABOUT IMAGE
        // ===  ===  ===  ===  ===  ===  ===  =
        if ( $request->hasFile( 'image' ) ) {

            if ( $setting->about_photo ) {
                Storage::delete( $setting->about_photo );
            }

            $path = $request->file( 'image' )->store( 'images' );
            $validated[ 'about_photo' ] = $path;
        }

        // ===  ===  ===  ===  ===  ===  ===  =
        // FAVICON UPLOAD ( FIXED )
        // ===  ===  ===  ===  ===  ===  ===  =
        if ( $request->hasFile( 'favicon' ) ) {

            // delete old favicon
            if ( $setting->favicon && Storage::exists( $setting->favicon ) ) {
                Storage::delete( $setting->favicon );
            }

            $path = $request->file( 'favicon' )->store( 'favicon' );
            $validated[ 'favicon' ] = $path;
        }

        // ===  ===  ===  ===  ===  ===  ===  =
        // UPDATE DATABASE
        // ===  ===  ===  ===  ===  ===  ===  =
        $setting->update( $validated );

        return to_route( 'admin.setting.index' )
        ->with( 'message', 'Data Updated Successfully' );
    }
}

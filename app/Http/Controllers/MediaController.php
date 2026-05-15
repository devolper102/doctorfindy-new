<?php
/**
 * Class MediaController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App\Http\Controllers;

use Session;
use App\Helper;
use App\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

/**
 * Class MediaController
 *
 */
class MediaController extends Controller
{
    /**
     * Upload Image to temporary folder.
     *
     * @param mixed  $request   request attributes
     * @param string $type      upload Type
     * @param string $file_name input name attribute
     * @param string $img_type  Image type.
     * 
     * @return \Illuminate\Http\Response
     */
    public function uploadTempImage(Request $request, $type, $file_name, $img_type='')
    {
        $path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/' . $type . '/temp/' : Helper::PublicPath() . '/uploads/' . $type . '/temp/';
        // dd($path);
        $image_size = !empty($img_type) && $img_type != 'null' ? Helper::getImageSizes($img_type) : array();
        if (!empty($request[$file_name])) {
            $file = $request[$file_name];
            return Helper::uploadTempImage($path, $file, $type, $image_size, $img_type);
        }
    }
    //  public function changeProfileImage(Request $request)
    // {
    //     $file_name = $request->file_name;
    //      $type = $request->type;
    //     $img_type = 'profile_img';
    //     $path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/' . $type . '/temp/' : Helper::PublicPath() . '/uploads/' . $type . '/temp/';
    //     $image_size = !empty($img_type) && $img_type != 'null' ? Helper::getImageSizes($img_type) : array();
    //       if (!empty($request[$file_name])) {
    //         $file = $request[$file_name];
    //         $fileName = $file->getClientOriginalName();
    //         $userId = Auth::guard('api')->user()->id;
    //         $userMeta = UserMeta::where('user_id', $userId)->first();
    //         $userMeta->avatar = $fileName;
    //         $userMeta->save();
    //         return Helper::uploadTempImage($path, $file, $type, $image_size, $img_type);
    //     }
    // }
    public function changeProfileImage(Request $request)
    {
        $file_name = 'avatar_img';  // assuming 'avatar_img' is the input name in the form
        $type = 'users';
        $img_type = 'profile_img';
        $path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/' . $type . '/temp/' : Helper::PublicPath() . '/uploads/' . $type . '/temp/';
        $image_size = !empty($img_type) && $img_type != 'null' ? Helper::getImageSizes($img_type) : array();
    
        if ($request->hasFile($file_name)) {
            $file = $request->file($file_name);
            // $fileName = $file->getClientOriginalName();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
             $fileName = $originalName . '.webp';
            $userId = Auth::guard('api')->user()->id;
    
            // Optionally save the filename to user meta
            // $userMeta = UserMeta::where('user_id', $userId)->first();
            $userMeta = UserMeta::firstOrNew(['user_id' => $userId]);
            $userMeta->avatar = $fileName;
            $userMeta->save();
    
            // Upload temp image
            Helper::uploadTempImage($path, $file, $type, $image_size, $img_type);
    
            return response()->json(['status' => 'success', 'file_name' => $fileName], 200);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Image upload failed.'], 400);
    }
    /**
     * Download file.
     *
     * @param type    $type     file type
     * @param integer $id       id
     * @param string  $filename file typname
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    function getFile($type, $id, $filename)
    {
        $disk = Helper::getPublicStorageDisk();
        if (!empty($type) && !empty($id) && !empty($filename)) {
            if (file_exists(Helper::publicPath().'/uploads/'.$type . '/' . $id . '/' . $filename)) {
                return Storage::disk($disk)->download('/' . $type . '/' . $id . '/' . $filename);
            } else {
                Session::flash('error', trans('lang.file_not_found'));
                return Redirect::back();
            }
        } else {
            abort(404);
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Conservationquestionnaire extends Model
{
    public $timestamps = false;
    
    static function validator($request){
        $validatedData = $request->validate([
            'activityName' => ['required', 'string', 'min:2', 'max:20'],
            'zip21' => ['required', 'string', 'regex:/^[0-9]{3}/u','max:3'],
            'zip22' => ['required', 'string', 'regex:/^[0-9]{4}/u','max:4'],
            'addr21' => ['required', 'string', 'max:40'],
            'shelter'=> ['required'],
            'pet' => ['required'],
            'area' => ['required'],
            'url' => ['required'],
            'profile' => ['required', 'string', 'min:20', 'max:150'],
        ]);
    }

    static function store($data, $user){
        // dd($data);
        $fileName = "profile={$user['id']}.".$data['profileImg'];
        Conservationquestionnaire::storeS3($fileName, $user);
        

        $shelter = $data['shelter'];
        if ($data['otherText'] != null){
            $shelter[] = $data['otherText'];
        }

        Conservationquestionnaire::where('user_email', $user['email'])->update([
            'answered' => '1',
            'conservationStatus' => $data['conservationStatus'],
            'activityName' => $data['activityName'],
            'address' => $data['address'],
            'postalCode' => $data['zipCode'],
            'shelter' => implode('&', $shelter),
            'pet' => implode('&', $data['pet']),
            'area' => implode('&', $data['area']),
            'url' => implode('&', $data['url']),
            'profile' => $data['profile'],
        ]);
    }

    static function storeImg($file, $user){
        $fileName = "profile={$user['id']}.".$file->getClientOriginalExtension();

        $target_path = public_path("uploads/id={$user['id']}/");
        if (file_exists($target_path)) {
            $images = glob(public_path("uploads/id={$user['id']}/*"));
            foreach ($images as $img){
                unlink($img);
            }
            $file->move($target_path, $fileName);
        }else{
            $file->move($target_path, $fileName);
        }
    }

    static function storeS3($fileName, $user){
        $exs = ['jpeg', 'jpg', 'png'];
        foreach ($exs as $ex){
            if (Storage::disk('s3')->exists("/profile/profile={$user['id']}.{$ex}")){
                $s3_delete = Storage::disk('s3')->delete("/profile/profile={$user['id']}.{$ex}");
            }
        }
        $path = Storage::disk('s3')->putFileAs('/profile', new File("uploads/id={$user['id']}/{$fileName}"), $fileName, 'public');
    }
}

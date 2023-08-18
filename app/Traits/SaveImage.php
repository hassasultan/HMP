<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SaveImage
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function NicImage($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image/Nic'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image/Nic'.'/'.'img'),$filenamenew);
        return $filenamepath;
    }
    public function HealthCertificate($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image/HealthCertificate'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image/HealthCertificate'.'/'.'img'),$filenamenew);
        return $filenamepath;
    }
    public function CharacterCertificate($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image/CharacterCertificate'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image/CharacterCertificate'.'/'.'img'),$filenamenew);
        return $filenamepath;
    }
    public function ProfileImage($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'img'),$filenamenew);
        return $filenamepath;
    }
    public function Licence($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'licence/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'licence'),$filenamenew);
        return $filenamepath;
    }
    public function vehicle($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'vehicle/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'vehicle'),$filenamenew);
        return $filenamepath;
    }
    public function fitness($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'fitness/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'fitness'),$filenamenew);
        return $filenamepath;
    }
    public function vehicle_docs($image,$loc)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = $loc.$filenamenew;
        $filename       = $img->move(public_path('storage/'.$loc),$filenamenew);
        return $filenamepath;
    }

}

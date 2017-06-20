<?php

namespace boxue\Handler;

use App\Models\User;
use Image;
use Auth;
use boxue\Handler\Exception\ImageUploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ImageUploadHandler
{
    protected $file;
    protected $allowed_exception = ["png", "jpg", "gif", "jpeg"];

    public function uploadAvatar($file, User $user)
    {
        $this->file = $file;
        $this->checkAllowedExtensionsOrFail();

        $avatar_name = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension() ?: 'png';
        $this->saveImageToLocal('avatar', 380, $avatar_name);

        return ['filename' => $avatar_name];
    }


    public function uploadImage($file)
    {
        $this->file = $file;
        $this->checkAllowedExtensionsOrFail();

        $local_image = $this->saveImageToLocal('topic', 1440);
        return ['filename' => get_user_static_domain().$local_image];
    }

    protected function checkAllowedExtensionsOrFail()
    {
        $extension = strtolower($this->file->getClientOriginalExtension());
        if ($extension && !in_array($extension, $this->allowed_exception)) {
            throw new ImageUploadException('You can only upload image with extensions:' . implode($this->allowed_exception, ','));
        }
    }

    protected function saveImageToLocal($type, $resize, $filename = '')
    {
        $folderName = ($type == 'avatar')
            ? 'uploads/avatars'
            : 'uploads/images/' . date("Ym", time()) . '/' . date("d", time()) . '/' . Auth::user()->id;

        $destinationPath = public_path() . '/' . $folderName;
        $extension = $this->file->getClientOriginalExtension() ?: 'png';
        $safeName = $filename ? :str_random(10) . '.' . $extension;
        $this->file->move($destinationPath, $safeName);

        if ($this->file->getClientOriginalExtension() != 'gif') {
            $img = Image::make($destinationPath . '/' . $safeName);
            $img->resize($resize, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save();
        }

        return $folderName . '/' . $safeName;

    }
}
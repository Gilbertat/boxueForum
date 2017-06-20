<?php

namespace App\Models\Traits;

trait AvatarHelper
{
    public function updateAvatar($file)
    {
        $upload_status = app('boxue\Handler\ImageUploadHandler')->uploadAvatar($file, $this);
        $this->avatar = $upload_status['filename'];
        $this->save();

        return ['avatar' => $this->avatar];
    }
}
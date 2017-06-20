<?php

namespace boxue\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

    public function gravatar($size = 100)
    {
        $postfix = $size > 0 ? "?/imageView2/1/w/{$size}/h/{$size}" : "";
        return cdn('uploads/avatars/' . $this->avatar) . $postfix;
    }

}
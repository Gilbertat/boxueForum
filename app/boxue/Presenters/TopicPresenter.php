<?php

namespace boxue\Presenters;

use Laracasts\Presenter\Presenter;
use Illuminate\Support\Facades\Input;
use Config;

class TopicPresenter extends Presenter
{
    public function replyIndex($index)
    {
        $index += 1;
        $currentPage = Input::get('page') ?: 1;
        return ($currentPage - 1) * Config::get('boxue.replies_perPage') + $index;
    }
}
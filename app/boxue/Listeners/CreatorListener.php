<?php

namespace boxue\Listeners;

interface CreatorListener
{
    public function creatorSucceed($model);
    public function creatorFailed($errors);
}
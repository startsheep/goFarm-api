<?php

namespace App\Http\Traits;

trait MessageFixer
{
    protected function error($message)
    {
        return back()->withErrors(['msg' => $message]);
    }
}

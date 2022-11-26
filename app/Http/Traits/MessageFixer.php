<?php

namespace App\Http\Traits;

trait MessageFixer
{
    protected function error($message)
    {
        return back()->withErrors(['msg' => $message]);
    }

    protected function success($route, $message)
    {
        return redirect($route)->with('message', '<div class="card bg-success p-3 text-white">' . $message . '</div>');
    }
}

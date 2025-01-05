<?php

namespace App\Observers;

use App\Models\Social;
use Illuminate\Support\Facades\Storage;

class SocialObserver
{
    public function created(Social $row)
    {

            
    }

    public function updating (Social $row)
    {
        if (request()->has('image')) {
            if ($row->getRawOriginal('image') != 'default.png' && $row->getRawOriginal('image') != null){
                Storage::disk("".env('FILESYSTEM_DRIVER')."")->delete($row->getRawOriginal('image'));
            }
        }
    }

    /**
     * Handle the Social "deleted" event.
     *
     * @param \App\Social $row
     * @return void
     */
    public function deleted(Social $row)
    {
        if ($row->getRawOriginal('image') != 'default.png' && $row->getRawOriginal('image') != null){

            Storage::disk("".env('FILESYSTEM_DRIVER')."")->delete($row->getRawOriginal('image'));
        }
    }

}

<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function created(Product $row)
    {

            
    }

    public function updating (Product $row)
    {
        if (request()->has('image')) {
            if ($row->getRawOriginal('image') != 'default.png' && $row->getRawOriginal('image') != null){
                Storage::disk("".env('FILESYSTEM_DRIVER')."")->delete($row->getRawOriginal('image'));
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param \App\Product $row
     * @return void
     */
    public function deleted(Product $row)
    {
        if ($row->getRawOriginal('image') != 'default.png' && $row->getRawOriginal('image') != null){

            Storage::disk("".env('FILESYSTEM_DRIVER')."")->delete($row->getRawOriginal('image'));
        }
    }

}

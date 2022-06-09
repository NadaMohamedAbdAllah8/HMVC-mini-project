<?php

namespace App\Actions;

use App\Models\Image;
use Illuminate\Support\Facades\File;

class RemoveImageAction
{
    // delete image
    public function handle($imageable_id, $imageable_type)
    {
        try {
            $image = Image::where(['imageable_id' => $imageable_id,
                'imageable_type' => $imageable_type])->first();

            if (!is_null($image)) {
                if (File::exists($image->file_path)) {
                    File::delete($image->file_path);
                    $image->delete();
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

<?php

namespace App\Actions;

use App\Models\Image;

class StoreImageAction
{
    // add image
    public function handle($image, $imageable_id, $imageable_type, $folderParent)
    {
        try {
            // upload the image
            $name = $image->getClientOriginalName();

            $filePath = $folderParent . '/' . $imageable_id . '/';

            $destinationPath = public_path($filePath);

            $image->move($destinationPath, $name);

            // create new record in image table
            $image = Image::create([
                'file_path' => $filePath . $name,
                'imageable_id' => $imageable_id,
                'imageable_type' => $imageable_type,
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

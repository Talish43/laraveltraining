<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(UpdateAvatarRequest $request)
    {
//        $path = $request->file('avatar')->store('avatars','public');
        $path =Storage::disk('public')->put('avatars',$request->file('avatar'));

        if($oldAvatar = auth()->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }
        auth()->user()->update(['avatar'=>$path]);
        return Redirect::route('profile.edit')->with('message', 'Avatar Is Updated');
    }
}

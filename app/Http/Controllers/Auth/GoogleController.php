<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\User;

use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;

use Exception;

use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function handleGoogleCallback()

    {


//        try {

        $user = Socialite::driver('google')->stateless()->user();


        $name = explode(' ',$user->getName());
        $create['fname'] = $name[0];
        $create['lname'] = $name[1];

        $create['email'] = $user->getEmail();

        $create['google_id'] = $user->getId();


        $create['code_melli'] = random_int(1000000000,2000000000);
        $create['username'] = str_random(10);
        if (is_null($user->getAvatar())) {
            $create['image_path'] = "images/users/profile.png";

        } else {
            $create['image_path'] = $user->getAvatar();
        }
        $create['type'] = 0;
        $create['is_admin'] = 0;


        $userModel = new User;

        $createdUser = $userModel->addNew($create);


           Auth('user')->loginUsingId($createdUser->id);


        return redirect()->route('user.home');


//        } catch (Exception $e) {
//
//var_dump( $e->getMessage());
//
//         //   return redirect('auth/google');
//
//
//
//        }

    }
}

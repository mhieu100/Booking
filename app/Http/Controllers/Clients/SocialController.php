<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Clients\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SocialController extends Controller
{

private $users;

public function __construct()
{
$this->users = new Login();
}

/*
========================
LOGIN GOOGLE
========================
*/

public function google()
{
return Socialite::driver('google')->redirect();
}

public function googleCallback()
{

$googleUser = Socialite::driver('google')->stateless()->user();

$user = $this->users
->where('email',$googleUser->email)
->first();

/* nếu chưa có user thì tạo */

if(!$user){

$user = $this->users->create([

'username' => $googleUser->name,

'email' => $googleUser->email,

'password' => bcrypt(Str::random(16)),

'provider' => 'google',

'provider_id' => $googleUser->id,

'IpAdress' => request()->ip(),

'isActive' => 1,

'status' => 1

]);

}

Session::put('user',$user);

return redirect('/')->with('success','Đăng nhập Google thành công');

}


/*
========================
LOGIN FACEBOOK
========================
*/

public function facebook()
{
return Socialite::driver('facebook')->redirect();
}
public function facebookCallback()
{
    try {

        $fbUser = Socialite::driver('facebook')
            ->stateless()
            ->user();

    } catch (\Exception $e) {

        return redirect('/login')
            ->with('error','Đăng nhập Facebook thất bại, vui lòng thử lại');
    }

    $email = $fbUser->email ?? $fbUser->id.'@facebook.com';

    $user = $this->users
        ->where('email',$email)
        ->first();

    if(!$user){

        $user = $this->users->create([

            'username' => $fbUser->name,

            'email' => $email,

            'password' => bcrypt(\Str::random(16)),

            'provider' => 'facebook',

            'provider_id' => $fbUser->id,

            'IpAdress' => request()->ip(),

            'isActive' => 1,

            'status' => 1

        ]);

    }

    \Session::put('user',$user);

    return redirect('/')
        ->with('success','Đăng nhập Facebook thành công');

}

}
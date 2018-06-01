<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CasController extends Controller
{
    use GuardHelpers;
    protected $cas;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cas = app('cas');
    }

    /**
     * Handle Miami Cas login
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($this->cas->isAuthenticated()) {
            $uniqueId = $this->cas->user();
            $username = $uniqueId . "@miamioh.edu";
            $user = User::where('email', $username)->first();

            $client = new Client();
            $res = $client->get("https://ws.miamioh.edu/person/{$uniqueId}.json");
            $res = json_decode($res->getBody(), true);
            $res = $res['personCollection'];
            $name = 'Unknown';
            if(count($res)) {
                $name = $res[0]['nameDisplayFormal'];
            }

            if($user) {
                if(!$user->is_miami) {
                    die("This account is not miami account, please login using email and password");
                }
                $user->update(['name' => $name]);
            } else {
                $user = User::create([
                    'role_id' => 4,
                    'is_miami' => 1,
                    'name' => $name,
                    'email' => $username,
                    'password' => Hash::make(str_random(16)),
                ]);
            }
            Auth::guard()->loginUsingId($user->id, 0);
            return redirect(route('home.index'));
        } else {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }
            $this->cas->authenticate();
        }
    }

    /**
     * Handle Miami Cas logout
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        if($this->cas->isAuthenticated()) {
            return redirect('/?cas=logout');
        } else {
            return redirect('/');
        }
    }
}

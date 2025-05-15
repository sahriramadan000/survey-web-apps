<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming you are using the User model

class LoginNewController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($this->attemptLogin($request)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                return response()->json(['success' => true, 'msg' => 'Login berhasil!']);
            }

            return response()->json(['failed' => true, 'msg' => 'Login failed. Username or Password wrong!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => $th->getMessage()]);
        }
    }

    protected function attemptLogin(Request $request)
    {
        // Find the user by username or email (adjust the field if necessary)
        $user = User::where('username', $request->input('username'))->orWhere('email', $request->input('username'))->first();

        // Check if user exists and the password is correct
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Log in the user manually
            Auth::login($user, $request->boolean('remember'));

            return true;
        }

        return false;
    }
}

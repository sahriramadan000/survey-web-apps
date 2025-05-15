<?php

namespace App\Http\Controllers;

use App\Mail\SendForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{

    public function index()
    {
        $data['page_title'] = 'Lupa Password';
        return view('auth.forgot-password.index', $data);
    }
    public function sendEmail(Request $request)
    {
        try {

            $user = User::where('email', $request->email)->first();

            if (empty($user)) {
                return response()->json(['failed' => true, 'msg' => 'Email dengan akun tersebut tidak terdaftar!']);
            }
            $email = $request->email;
            $token = Str::random(60);
            $expiresAt = now()->addMinutes(2); // Token valid selama 1 menit

            // Simpan token dan waktu kedaluwarsa di database
            DB::table('password_resets')->updateOrInsert(
                ['email' => $email],
                ['token' => $token, 'expires_at' => $expiresAt]
            );

            // Kirim email
            Mail::to($email)->send(new SendForgotPassword([
                'email' => $email,
                'token' => $token,
                'expires_at' => $expiresAt->timestamp, // Kirim waktu kadaluwarsa sebagai timestamp
            ]));

            return response()->json(['success' => true, 'msg' => 'Email Berhasil dikirim!']);
        } catch (\Throwable $th) {
            return response()->json(['failed' => true, 'msg' => 'Gagal Simpan Data!']);
        }
    }


    public function reset()
    {
        $data['page_title'] = 'Reset Password';
        return view('auth.forgot-password.reset', $data);
    }

    public function prosesReset(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()
            ]);
        }

        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        // Cek token di database
        $reset = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$reset || now()->greaterThan($reset->expires_at)) {
            return response()->json([
                'success' => false,
                'msg' => 'Token reset password tidak valid atau sudah kedaluwarsa.'
            ]);
        }

        // Perbarui password
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            DB::table('users')->where('email', $email)->update(['password' => Hash::make($password)]);
            // Hapus token reset password setelah digunakan
            DB::table('password_resets')->where('email', $email)->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Password berhasil diperbarui.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Email tidak ditemukan.'
            ]);
        }
    }

    public function successReset()
    {
        $data['page_title'] = 'Success Reset Password';
        return view('auth.forgot-password.success-reset', $data);
    }
}

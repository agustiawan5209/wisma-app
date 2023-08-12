<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\DetailUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->all());
        $request->user()->fill($request->validated());
        if (Auth::user()->role == 'User') {
            DetailUser::where('user_id', Auth::user()->id)->update([
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'jenkel' => $request->jenkel,
            ]);

            if ($request->foto !== null) {
                $file = $request->file('foto');
                $nama = md5($file->getClientOriginalName());
                $file->storeAs('public', 'profile/' . $nama);
                DetailUser::where('user_id', Auth::user()->id)->update([
                    'foto' => $nama,
                ]);
            }
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

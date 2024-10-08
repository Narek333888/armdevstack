<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileDestroyRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('dashboard.admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', __('profile.saved'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(ProfileDestroyRequest $request): RedirectResponse
    {
        /*$request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);*/

        $user = $request->user();

        if (!Hash::check($request->input('password'), $user->password))
            return redirect()->back()->with('fail', __('validation.current_password'));

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

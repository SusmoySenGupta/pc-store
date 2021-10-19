<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UserRequest as Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \IIlluminate\View\View
     */
    public function edit(User $user): View
    {
        return view('admin.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        try {
            $user->update($request->all());

            Alert::toast('Profile updated successfully', 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-right')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.user.edit', $user->id);

        }
        catch (\Exception$e)
        {
            return redirect()->route('admin.user.edit', $user->id)
                ->withinput()
                ->with('error', $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UserRequest as Request;

class UserController extends Controller
{
    private const PASSWORD = 'password';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $users = User::exceptSuperAdmin()->latest()->paginate(10);

        return view('admin.all-users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $this->authorize('create', User::class);

        return view('admin.create-admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        try {
            $password = Hash::make(self::PASSWORD);

            User::create($request->all() + ['password' => $password, 'role' => User::ROLE_ADMIN]);
            
            toast('Admin added successfully', 'success');

            return redirect()->route('admin.user.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \IIlluminate\View\View
     */
    public function edit(User $user): View
    {
        $this->authorize('view', $user);

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
        $this->authorize('update', $user);

        try {
            if ($request->hasFile('profile_photo'))
            {
                $image = $request->file('profile_photo');

                if (Storage::exists($user->profile_photo))
                {
                    Storage::delete($user->profile_photo);
                }

                $file_name  = uniqid() . '.' . $image->extension();
                $image_path = $image->storeAs('public/images/profile', $file_name);

                $user->profile_photo = $image_path;
            }

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

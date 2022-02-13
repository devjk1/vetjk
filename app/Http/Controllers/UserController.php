<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::paginate(10);

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->safe()->only([
            'first_name',
            'last_name',
            'email',
            'phone',
        ]);

        $owner = User::create(array_merge($validated, [
            'password' => Hash::make('password'),
        ]));

        // Could redirect to the scaffolded Register route for registering Owners with role = 'owner'
        // Then manually set $user->role = 'vet' (default is 'owner')

        return redirect(route('users.show', $owner->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', User::find($id));

        $owner = User::with(['patients'])->find($id);

        return Inertia::render('Users/Show', [
            'owner' => new UserResource($owner),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', User::find($id));

        $owner = User::find($id);

        return Inertia::render('Users/Edit', [
            'owner' => new UserResource($owner),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->authorize('update', User::find($id));

        $owner = User::find($id);

        $validated = $request->safe()->only([
            'first_name',
            'last_name',
            'email',
            'phone',
        ]);

        $owner->first_name = $validated['first_name'];
        $owner->last_name = $validated['last_name'];
        $owner->email = $validated['email'];
        $owner->phone = $validated['phone'];
        $owner->save();

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::find($id));

        $owner = User::find($id);

        $owner->delete();

        return redirect(route('users.index'));
    }
}

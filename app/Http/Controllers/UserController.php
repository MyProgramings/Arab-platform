<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\StoreUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
{
    use PasswordValidationRules;
    
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create()
    {
        return view('admin.users.register');
    }

    public function store(StoreUsersRequest $request)
    {
        $this->user::create([
            'name'    => $request->name,
            'user_name'    => $request->user_name,
            'email'    => $request->email,
            'level'    => $request->level,
            'department_id'    => $request->department_id,
            'password'    => Hash::make($request->password),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'administration_level'    => $request->administration_level,
        ]);
        return redirect(Route('channels.index'))->with(
            'success',
            'تم اضافه المادة بنجاح'
        );
    }
}

<?php


namespace App\Http\Controllers;


use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->email = $request->email;
        if ($user->isDirty()) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;

        $user->update();
        return redirect('home');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['success' => 'Record has been deleted']);
    }

    public function unverify(User $user)
    {
        $user->email_verified_at = null;
        $user->update();

        return redirect('home');
    }
}

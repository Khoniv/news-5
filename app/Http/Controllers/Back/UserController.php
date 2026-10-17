<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 1) {
            $users = User::get();
        }else{
            $users = User::whereId(Auth::user()->id)->get();
        }

        return view(
            'back.user.index',
            [
                'users' => $users
            ]

        );
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return back()->with('success', 'User Created');
    }



    public function update(UserUpdateRequest $request, $id)
{
    $data = $request->validated();

    // Jika password diisi, enkripsi dan simpan
    if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    } else {
        unset($data['password']); // Hapus dari data jika kosong
    }

    // Perbarui semua data termasuk role
    User::find($id)->update($data);

    return back()->with('success', 'User Updated');
}


    public function destroy(string $id)
    {
        User::find($id)->delete();

        return back()->with('success', 'User deleted successfully');  // Pastikan ini mengirimkan pesan ke session
    }
}

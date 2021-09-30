<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller implements BaseInterface, UserInterface
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    function index()
    {
        $users = User::all();
        return view('users.list', compact('users'));

    }

    function detail($id)
    {
        echo $id;
    }

    function getComment($idUser, $idComment = 1)
    {

    }

    function create()
    {
        return view('users.add');
    }

    function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    function getPostOfUser($idUser)
    {
        // TODO: Implement getPostOfUser() method.
    }

    function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('users.index');

    }

    function update($id)
    {
        $user = User::findOrFail($id);
        return \view('users.update', compact('user'));
    }

    function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('users.index');
    }
}

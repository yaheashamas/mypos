<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware(['permission:create_users'])->only('creat');
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->search('admin',$request->search,'first_name','last_name');
        // $users = $this->userRepository->all();
        return view('dashboard.users.index',compact('users'));
    }//end of index

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UserRequest $request)
    {
        $array = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password_confirmation),
        ];
        $user = $this->userRepository->create($array);
        $user->attachRole('admin');
        $user->syncPermissions($request->psermition);
        session()->flash('success',__('site.message_add'));
        return redirect()->back();
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $user = $this->userRepository->getById($user->id);
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(UserUpdateRequest $request ,User $user)
    {
        $array = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ];
        $user = $this->userRepository->updateById($user->id,$array);
        $user->syncPermissions($request->psermition);
        session()->flash('success',__('site.message_update'));
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $this->userRepository->deleteById($user->id);
        session()->flash('success',__('site.message_delete'));
        return redirect()->route('dashboard.users.index');
    }
}

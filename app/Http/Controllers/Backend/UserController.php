<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\OrderItem;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function index()
    {
        $users = User::leftJoin(
            'comment_ratings',
            'users.id',
            '=',
            'comment_ratings.user_id')
            ->selectRaw('users.*,count(comment_ratings.user_id) as total_comment')
            ->groupBy('users.id')
            ->orderBy('role')
            ->paginate(10);

        return view('Admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)
            ->with('products')
            ->first();

        return view('Admin.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::where('id', '=', $id)->firstOrFail();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if (Input::hasFile('userPic')) {
                if ($user->picture) {
                    unlink(public_path($user->picture));
                }

                $file = $request->file('userPic');
                $file_extension = $file->getClientOriginalExtension();
                $file_name = uniqid('img_') . '.' . $file_extension;
                $user->picture = '/upload/userPic/' . $file_name;
                $file->move('upload/userPic/', $file_name);
            }
            $user->save();

            return redirect()
                ->route('user.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Update User.']);
        } catch (Exception $e) {
            return redirect()
                ->route('user.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Update User.']);
        }
    }

    public function store(UserRegisterRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();

            return redirect()
                ->route('user.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Add User.']);
        } catch (Exception $e) {
            return redirect()
                ->route('user.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Add User.']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', '=', $id)->firstOrFail();
            if ($user->picture) {
                unlink(public_path($user->picture));
            }

            $user->products()->detach();
            $getOrders = $user->orders()->get();

            foreach ($getOrders as $getOrder) {
                OrderItem::where('order_id', $getOrder->id)->delete();
            }

            $user->orders()->delete();
            $user->delete();
            DB::commit();

            return redirect()
                ->route('user.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Delete User.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->route('user.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Delete User.']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    // ユーザー詳細 //
    public function show($id)
    {
        $user = User::find($id);
        $cafes = $user->cafes()->orderBy('created_at', 'desc')->paginate(5);
        
        $data = [
            'user' => $user,
            'cafes' => $cafes,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    // プロフィール編集 //
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    // プロフィール更新 //
    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        
        if (isset($request->icon)) {
            $icon = $request->file('icon')->getClientOriginalName();
            $path = Storage::disk('s3')->putFileAs('/icon', $request->file('icon'), $icon, 'public');
            $user->icon = $path;
            $user->name = $request->name;
            $user->content = $request->content;
            $user->save();
        }
        else {
            $user->name = $request->name;
            $user->content = $request->content;
            $user->save();
        }
        
        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    // お気に入りの取得 //
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(5);
        
        $data = [
            'user' => $user,
            'favorites' => $favorites,
        ];
        
        $data += $this->counts($user);
        
        return view('users.favorites', $data);
    }
}

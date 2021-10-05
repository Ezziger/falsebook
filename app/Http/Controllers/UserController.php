<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('user/profil', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id)->load('messages'); //load charge la ressource demandée
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        $updateUser = $request->validate([
            'image' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'pseudonyme' => 'required',
            'email' => 'required',
        ]);

        $updateUser = $request->except('_token', '_method');

        if($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $updateUser['image'] = "/images/" . $imageName;
        }

        User::whereId($id)->update($updateUser);
        return redirect()->route('profil')
                         ->with('success', 'Votre profil a bien été mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('register')
                         ->with('success', 'Votre profil a été supprimé !');
    }

    public function update_password(Request $request, $id) {

        $user = User::FindOrFail($id);
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|confirmed|max:15',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
        ]);

        if (Hash::check($request->input('oldPassword'), $user->password)) {
            if($request->input('oldPassword') !== $request->input('newPassword')) {
                $user->password = Hash::make($request->input('newPassword'));
                $user->save();
                return redirect()->route('profil')
                                 ->with('message', 'Votre profil a bien été mis à jour !');
            } else {
                return redirect()->back()->withErrors(['Attention !', 'ancien et nouveau mot de passe identiques !']);
            }
        } else {
            return redirect()->back()->withErrors(['Attention !', 'mot de passe incorrect !']);
        }
    }

}


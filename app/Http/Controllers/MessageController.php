<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(10);
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = "";
        $newMessage = $request->validate([
            'content' => 'required',
        ]);

        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        
        $newMessage = new Message;
        $newMessage->image = '/images/' . $imageName;
        $newMessage->content = $request->content;
        $newMessage->user_id = auth()->user()->id;
        $newMessage->save();
        return redirect()->route('messages.index')
                         ->with('success', 'Votre message a bien été posté !' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id)->load('user');
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.edit', compact('message'));
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
        $message = Message::findOrFail($id);
        $this->authorize('update', $message);
        $updateMessage = $request->validate([
            'image' => 'nullable',
            'content' => 'required',
        ]);

        $updateMessage = $request->except('_token', '_method');

        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $updateMessage['image'] = "/images/" . $imageName;
        }

        Message::whereId($id)->update($updateMessage);
        return redirect()->route('messages.index')
                         ->with('success', 'Votre message a été modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $this->authorize('delete', $message);
        $message->delete();
        return redirect()->route('messages.index')
                         ->with('success', 'Votre profil a été supprimé !');
    }

    public function search() {
        $q = request()->input('q');
        $messages = Message::where('content', 'like', "%$q%")
               ->orWhere('tags', 'like', "%$q%")
               ->paginate(5);
        return view('messages.search')->with('messages', $messages);
    }
}

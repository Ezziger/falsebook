<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $newComment = $request->validate([
            'content' => 'required',
            'tags' => 'nullable',
        ]);

        if ($request->input('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        
        $newComment = new Comment;
        $newComment->image = '/images/' . $imageName;
        $newComment->content = $request->content;
        $newComment->tags = $request->tags;
        $newComment->message_id = $request->message_id;
        $newComment->user_id = auth()->user()->id;
        $newComment->save();
        return redirect()->back()
                         ->with('success', 'Votre Commentaire a bien été posté !' );
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
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
        $comment = Comment::findOrFail($id);
        $this->authorize('update', $comment);
        $updateComment = $request->validate([
            'image' => 'nullable',
            'content' => 'required',
            'tags' => 'nullable'
        ]);

        $updateComment = $request->except('_token', '_method');

        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $updateComment['image'] = "/images/" . $imageName;
        }

        Comment::whereId($id)->update($updateComment);
        return redirect()->route('messages.show', $comment->message_id)
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
        $comment = Comment::findOrfail($id);
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', 'commentaire supprimé');
    }
}

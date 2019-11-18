<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::latest()->paginate(5);

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Règles de validation des données
        $data = $request->validate([
           'title' => 'required|min:3',
           'content' => 'required|min:10',
        ]);
        //On crée le topic en utilisant la relation
        $topic = auth()->user()->topics()->create($data);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        // Bloquer l'accès à la vue /topis/edit/id si l'utilisateur n'est l'auteur du topic
        $this->authorize('update', $topic);  //edit ==> TopicPolicy==>edit()
        return view('topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        // Bloquer la mise à jour sil'utilisateur n'est pas l'auteur
        $this->authorize('update', $topic); //update ==> TopicPolicy==>update()
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);
        $topic->update($data);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        // Bloquer la suppression sil'utilisateur n'est pas l'auteur
        $this->authorize('delete', $topic); // delete ==> TopicPolicy==>delete()
        Topic::destroy($topic->id);
        return redirect('/');
    }
}

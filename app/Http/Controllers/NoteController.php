<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getNotes(){
        $notes = Note::all();
        return response()->json($notes);
    }

    public function createNote()
    {
        $note = Note::create(request()->all());
        return response()->json($note);
    }

    public function updateNote($id)
    {
        $note = Note::find($id);
        $note->update(request()->all());
        return response()->json($note);
    }

    public function deleteNote($id)
    {
        $note = Note::find($id);
        $note->delete();
        return response()->json('deleted');
    }
}

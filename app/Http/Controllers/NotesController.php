<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Events\NoteCreated;
use App\Models\Notes;

class NotesController extends Controller
{
    public function index(Notes $note)
    {
        $notes = Auth::user()->notes()->get();
        $slug = Str::slug($note->title);
        return view('notes.index', compact('notes','slug'));
    }

    public function edit(Notes $note, $slug)
    {
        $slug = Str::slug($note->title);
        if ($slug !== Str::slug($note->title)) {
            abort(404);
        }
        $notes = Auth::user()->notes()->get();  
        return view('notes.edit', compact('note', 'slug', 'notes'));
    }

    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'title' => 'required|max:30',
                'content' => 'nullable'
            ]
        );

        if (empty($data['content'])) {
            $data['content'] = ' ';
        }

        $note = Auth::user()->notes()->create($data);
        
        event(new NoteCreated($note));

        $notes = Auth::user()->notes()->get(); 
        $slug = Str::slug($note->title);


        // return with a sucess message; redirect to a get request since the last request was a POST request
        return redirect()->route('notes.edit', compact('slug', 'notes', 'note'));

    }

    
    public function update(Request $request, Notes $note)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:30',
                'content' => 'nullable'
            ]
        );

        // dd($data);

        if (empty($data['content'])) {
            $data['content'] = 'No content';
        }

        $noteUpdate = $note->update($data);
        $slug = Str::slug($note->title);

        if (!$noteUpdate) {
            return redirect()->back()->withErrors(['error' => 'Failed to update note.']);
        }   

        return redirect()->route('notes.edit', ['note' => $note->id, 'slug' => $slug])
            ->with('success', 'Note updated successfully.');
    }


    public function destroy(Notes $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note->delete();
        
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
//to be added:
//infinite loading
//pagination
//collaborative editing
//search
//delete buttonw works but bad positioning---Note done!


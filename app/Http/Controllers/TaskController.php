<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Assure-toi d'avoir un modèle Task

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date_echeance' => 'required|date',
            'priorite' => 'required|string'
        ]);

        Task::create([
            'titre' => $request->titre,
            'date_echeance' => $request->date_echeance,
            'priorite' => $request->priorite,
            'user_id' => auth()->id(), // Si tu veux lier la tâche à l'admin connecté
        ]);

        return redirect()->back()->with('success', 'Tâche ajoutée à l\'agenda !');
    }
    public function complete(Task $task)
{
    // On passe le statut à true
    $task->update(['est_terminee' => true]);

    return redirect()->back()->with('success', 'Tâche marquée comme terminée !');
}
}

<?php
use Illuminate\Support\Facades\Hash;
use App\Models\User;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

// 1. On vide la table users pour repartir à zéro
User::truncate();

// 2. On crée ton compte proprement
$user = User::create([
    'name' => 'Cheick Diawara',
    'email' => 'cheickdiawara@gmail.com',
    'password' => Hash::make('ti68175640'),
    'is_admin' => 1
]);

if (Hash::check('ti68175640', $user->password)) {
    echo "SUCCÈS : L'utilisateur est créé et le mot de passe est VALIDE.";
} else {
    echo "ERREUR : Le hachage ne fonctionne pas sur ce serveur.";
}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur le site</title>
</head>
<body>
<h1>Bonjour {{ $student->first_name }} {{ $student->last_name }}</h1>
<p>Nous sommes heureux de vous accueillir parmi nos enseignant.</p>
<p>Votre mot de passe temporaire est : <strong>{{ $password }}</strong></p>
<p>Merci de vous connecter et de mettre à jour votre mot de passe rapidement.</p>
</body>
</html>

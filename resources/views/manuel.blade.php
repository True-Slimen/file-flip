@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <h1 style="margin-bottom: 3rem;">Manuel</h1>

    <h2 >Dashboard</h2>
    <p>Cette page offre une vue d'ensemble ainsi qu'un accès à toutes les fonctionnalité du GED:</p>
    <ul>
        <li>La gestion des groupes: vous pourrez ici créer ainsi qu'assigner des utilisateurs à     des groupes. Il sera ensuite possible de partager les dossiers / fichiers que vous     souhaitez avec un groupe choisi. </li>
        <li>La liste des derniers fichiers que vous avez enregistré sur le GED.</li>
        <li>La liste des rôles qui vous sont assignés, vous permettant d'avoir accès à diverses     fonctionnalités sur le site. Si vous êtes administrateur vous pourrer ici assigner des     rôles à des utilisateurs.</li>
        <li>La liste des droits qui vous sont assignés, vous autorisants selon le type à (Voir /     Lire / Ecrire / Supprimer / Déplacer / Copier ) des fichiers / dossiers dans le GED. Si     vous êtes administrateur vous pourrer ici assigner des     droits à des utilisateurs.</li>
        <li>La liste des derniers utlisateurs à avoir créé un compte sur le site. Si vous êtes     administrateur vous pourrer ici créer des utilisateurs. </li>
    </ul>

    <h2 style="margin-top: 2rem;">Explore</h2>
    <p>Cette page est le coeur névralgique du Gestionnaire Electronique de Document:</p>
    <ul>
        <li> Sur la partie de droite, vous pourez découvrir l'espace dédié à la création de dossier.
Il suffit de renseigner le nom que vous souhaitez donné à votre dossier, et de selectionner
l'endroit où vous souhaitez qu'il soit créé. </li>
        <li>Sur la partie de gauche, vous retrouverez l'espace dédié à la mise en ligne de documents. Il faut dans un premier temps
sélectionner le dossier de destination du fichier, puis ensuite cliquer sur le bouton
"Choisir un fichier". Une fois votre fichier sélectionné, il vous suffit de cliquer sur le bouton
"Upload" afin qu'il intègre le GED.</li>
    </ul>

    <p>Si vous souhaitez des détails techniques, venez consultez notre wiki !</p>
    <a href="/wiki" class="btn custom-btn-secondary" 
">Wiki</a>

    <p>Maintenant que vous savez vous servir de File-Flip, c'est parti ! </p>
    <a href="/ged/root" class="btn custom-btn-secondary">J'explore GED</a>

</section>

@endsection
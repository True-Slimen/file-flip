@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">

    <h1>Wiki</h1>

        <h2>Déploiement depuis zéro</h2>

        <div>
            <h3>Depuis la VM</h3>
            <p>Une machine virtuelle de type Debian vous est fournie, possédant un script au démarrage, permettant d'accéder directement au site web via l'ip 192.168.1.199:8000.</p>
            <p>Pour se connecter à cette VM (sans interface graphique), vous pouvez utilisez ces identifiants : Username 'user' | Password 'user'.</p>
        </div>

        <div>
            <h3>Depuis une machine vierge</h3>

                <p>Pour déployer FileFlip depuis une machine vierge, il est nécessaire d'installer plusieurs outils.</p>
                <p>Voici les prérequis : </p>
                <ul>
                    <li>PHP version 7.2.5 ou plus (<a href="https://www.php.net/downloads.php">A télécharger ici</a>)</li>
                    <li>Laravel version 7.3 ou plus (<a href="https://laravel.com/docs/8.x/installation">A télécharger ici</a>)</li>
                    <li>Composer version 2.0.0 ou plus (<a href="https://getcomposer.org/download/">A télécharger ici</a>)</li>
                </ul>
        </div>

        <div>
            <p>Egalement, d'autres outils peuvent être pratiques pour le développement du projet (Mais non nécessaire à son développement)</p>
            <ul>
                <li>NodeJS version 14.17.0 LTS (<a href="https://nodejs.org/en/">A télécharger ici</a>)</li>
                <li>Git (<a href="https://git-scm.com/downloads">A télécharger ici</a>)</li>
            <ul>
        
            <p>En cas de la perte des fichiers du projets, vous pouvez le retrouver sur <a href="https://github.com/True-Slimen/file-flip">ce repository Github</a></p>

            <p>Il suffit, une fois ces différents composants installer, de lancer la commande "composer install" ou "php composer.phar install" pour installer les dépendances du projet.</p>
            <p>Une fois les dépendances lancées, la commande "php artisan serve" lancera le projet sur votre machine locale.</p>
        </div>

    <a href="/manuel" class="btn custom-btn-secondary">Lire le manuel</a>
</section>

@endsection
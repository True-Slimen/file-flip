@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <h1>Wiki</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, doloremque dolores doloribus culpa id debitis sed veniam? Nam numquam, assumenda enim unde ex blanditiis ducimus, sit nostrum est soluta repudiandae.</p>
</section>

<section class="container mb-5">
    <h4><strong>Déploiement depuis zéro</strong></h4>
    <h6><strong>Depuis la VM</strong></h6>
    <p>Une machine virtuelle de type Debian vous est fournie, possédant un script au démarrage, permettant d'accéder directement au site web via l'ip 192.168.1.199:8000.</p>
    <p>Pour se connecter à cette VM (sans interface graphique), vous pouvez utilisez ces identifiants : Username 'user' | Password 'user'.</p>
<h6><strong>Depuis une machine vierge</strong></h6>
    <p>Pour déployer FileFlip depuis une machine vierge, il est nécessaire d'installer plusieurs outils.</p>
    <p>Voici les prérequis : </p>
    <ul>
        <li>PHP version 7.2.5 ou plus (<a href="https://www.php.net/downloads.php">A télécharger ici</a>)</li>
        <li>Laravel version 7.3 ou plus (<a href="https://laravel.com/docs/8.x/installation">A télécharger ici</a>)</li>
        <li>Composer version 2.0.0 ou plus (<a href="https://getcomposer.org/download/">A télécharger ici</a>)</li>
    </ul>

    <p>Egalement, d'autres outils peuvent être pratiques pour le développement du projet (Mais non nécessaire à son exécution)</p>
    <ul>
        <li>NodeJS version 14.17.0 LTS (<a href="https://nodejs.org/en/">A télécharger ici</a>)</li>
        <li>Git (<a href="https://git-scm.com/downloads">A télécharger ici</a>)</li>
    <ul>

    <p>En cas de la perte des fichiers du projets, vous pouvez le retrouver sur <a href="https://github.com/True-Slimen/file-flip">ce repository Github</a></p>

    <p>Il suffit, une fois ces différents composants installer, de lancer la commande "composer install" ou "php composer.phar install" pour installer les dépendances du projet.</p>
    <p>Une fois les dépendances lancées, la commande "php artisan serve" lancera le projet sur votre machine locale.</p>
</section>
<section class="container mb-5">
    <hr>
    <h4><strong>Référentiel des informations utiles</strong></h4>
    <div class="mb-5">
        <p>Au lancement nous nous sommes concerté et avons définit un plan de route. Appuyé par nos connaissances respective, nos forces et faiblesses, les grandes étape sont étaient définit.</p>
        <p>Suite à ça nous avons globalement déterminé la base de données puis nous nous sommes répartit les tâches.</p>
        <p>En moyenne nous nous sommes répartit a trois sur le developpement et un sur l'infra.</p>
    </div>
    <div class="mb-5">
        <p>Avant de coder le projet nous avons voulus rassembler un maximum de compétences. Pour ce faire nous avons parcouru la <a href="https://laravel.com/docs/8.x">documentation officiel de Laravel</a>, suivie quelques <a href="https://www.youtube.com/watch?v=I-LOFM_p6BQ&list=PLeeuvNW2FHVgvC-PdSfi309DbDMoEswiT&index=13">tutoriel</a> et pratiqué.</p>
        <p>Nous avons souhaité utilisé la version 7.3, pour profiter de plus de ressources et retours d'expériences des utilisateurs.</p>
        <p>Majoritairement orienté javascript nous avons dût nous adapter au fonctionnement du framework. Il à était intéréssant de voir le fonctionnement du MVC au sein d'un framework php ou encore de travailler avec Eloquent, l'ORM maison.</p>
    </div>
    <div class="mb-5">
        <p>Appuyé par git, nous avons pu traivaillé en parallèle et versionner nos efforts.</p>
        <p>Quelques difficultés on était rencontré pour lancer le projet après récupération sur le dépôt distant mais nous avons rapidement pris l'habitude des commandes <i>php artisan</i> à utiliser.</p>
    </div>
    <div>
        <p>La difficulté majeur à était l'estimation de charge, face aux nombreux inconnus nous avons constatés des projections erronés.</p>
    </div>

    <div class="row">

        <ul class="col-4 list-resources">
            <li><a href="https://laravel.com/docs/8.x">Documentation Laravel</a></li>
            <li><a href="http://www.expertphp.in/article/laravel-53-creating-mysql-triggers-from-migration-with-example">Laravel Trigger</a></li>
            <li><a href="https://laracasts.com/discuss/channels/lumen/how-to-copy-files-in-laravel">Copies d'entités</a></li>
            <li><a href="https://stackoverflow.com/questions/40642977/laravel-pass-object-from-view-to-controller">Route</a></li>
        </ul>
    </div>

</section>
<section class="container mb-5">
    <p>Pour connaitre la procédure d'installation de File-Flip repportez vous à notre manuel</p>
    <a href="/manuel" class="btn custom-btn-secondary">Lire le manuel</a>
</section>

@endsection
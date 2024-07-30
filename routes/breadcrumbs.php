<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Programmes
Breadcrumbs::for('programs.index', function (BreadcrumbTrail $trail) {
    $trail->push('Programmes', route('programs.index'));
});

// Profil
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('programs.index');
    $trail->push('Modifier le profil', route('profile.edit'));
});

// Exercices
Breadcrumbs::for('exercises.index', function (BreadcrumbTrail $trail) {
    $trail->parent('programs.index');
    $trail->push('Exercices', url('/exercises'));
});

// Créer/modifier les programmes
Breadcrumbs::for('programs.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Modifier le programme', route('programs.edit', $id));
});

// Afficher les programmes
Breadcrumbs::for('programs.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Voir le programme', route('programs.show', $id));
});

// Gérer les utilisateurs
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('programs.index');
    $trail->push('Gérer les utilisateurs', route('users.index'));
});

// Afficher les utilisateurs
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('users.index');
    $trail->push('Voir l\'utilisateur', route('users.show', $id));
});
<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Profile
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Edit Profile', route('profile.edit'));
});

// Exercises
Breadcrumbs::for('exercises.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Exercises', url('/exercises'));
});

// Programs
Breadcrumbs::for('programs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Programs', route('programs.index'));
});

// Create/edit programs
Breadcrumbs::for('programs.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Edit Program', route('programs.edit', $id));
});

// Show programs
Breadcrumbs::for('programs.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Show Program', route('programs.show', $id));
});

// Manage Users
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Manage Users', route('users.index'));
});

// Show user ((user.show))
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('users.index');
    $trail->push('Show User', route('users.show', $id));
});
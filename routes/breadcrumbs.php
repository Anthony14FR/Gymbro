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

Breadcrumbs::for('programs.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Edit Program', route('programs.edit', $id));
});

Breadcrumbs::for('programs.exportPdf', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Export Program to PDF', route('programs.exportPdf', $id));
});


// Show programs
Breadcrumbs::for('programs.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('programs.index');
    $trail->push('Show Program', route('programs.show', $id));
});

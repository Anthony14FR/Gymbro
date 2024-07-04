<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Profile
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('profile.edit'));
});

// Exercises
Breadcrumbs::for('exercises.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Exercises', url('/exercises'));
});

// Programs
Breadcrumbs::for('programs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
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

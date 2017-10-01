<?php

return [
    'portfolio.portfolios' => [
        'index' => 'portfolio::portfolios.list resource',
        'create' => 'portfolio::portfolios.create resource',
        'edit' => 'portfolio::portfolios.edit resource',
        'destroy' => 'portfolio::portfolios.destroy resource',
    ],
    'portfolio.categories' => [
        'index' => 'portfolio::categories.list resource',
        'create' => 'portfolio::categories.create resource',
        'edit' => 'portfolio::categories.edit resource',
        'destroy' => 'portfolio::categories.destroy resource',
    ],
    'portfolio.brands' => [
        'index' => 'portfolio::brands.list resource',
        'create' => 'portfolio::brands.create resource',
        'edit' => 'portfolio::brands.edit resource',
        'destroy' => 'portfolio::brands.destroy resource',
    ],
// append



];

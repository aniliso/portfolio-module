<?php

return [
    'category' => [
        'index' => 'portfolio/categories',
        'slug'  => 'portfolio/category/{slug}'
    ],
    'portfolio' => [
      'group' => 'portfoy/group/{id}',
      'index' => 'portfolio/index',
      'slug'  => 'portfolio/{slug}'
    ],
    'brand' => [
      'index' => 'portfolio/brand',
      'slug'  => 'portfolio/brand/{slug}'
    ]
];
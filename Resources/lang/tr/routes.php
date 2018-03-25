<?php

return [
  'category' => [
      'index' => 'portfoy/kategoriler',
      'slug'  => 'portfoy/kategori/{slug}'
  ],
  'portfolio' => [
      'group' => 'portfoy/group/{id}',
      'index' => 'portfoyler',
      'slug'  => 'portfoy/{slug}'
  ],
  'brand' => [
      'index' => 'portfoy/marka',
      'slug'  => 'portfoy/marka/{slug}'
  ]
];
<?php

$app->on('admin.init', function () {
  $this->helper('admin')->addAssets('wufoo:assets/field-wufoo-select.tag');
});

$app->on('cockpit.rest.init', function ($routes) {
  $routes['wufoo'] = 'Wufoo\\Controller\\WufooApi';
});
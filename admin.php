<?php

$app->on('admin.init', function () {
  $this->helper('admin')->addAssets('wufoo:assets/field-wufoo-select.tag');
});
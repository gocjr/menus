<?php
$colLeft = [
    'title',
    'slug'
];
$this->set(compact('colLeft', 'colRight'));
$this->extend('Appearances.Admin/Common/index');

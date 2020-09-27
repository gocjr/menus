<?php
$colLeft = [
    'title',
    'slug'
];

$this->set(compact('colLeft'));
$this->extend('Appearances./Admin/Common/form');

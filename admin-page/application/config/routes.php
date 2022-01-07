<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['kategori/(:any)/detail'] = 'Kategori/kategori_detail/$1';
$route['kategori_produk/(:any)/detail'] = 'Kategori_produk/kategori_detail/$1';
$route['kategori/(:any)/foto'] = 'Kategori/foto_wisata/$1';
$route['kategori_produk/(:any)/foto'] = 'Kategori_produk/foto_produk/$1';
$route['kategori/(:any)/fasilitas'] = 'Kategori/fasilitas_wisata/$1';
$route['kategori/(:any)/pendukung'] = 'Kategori/pendukung_wisata/$1';
$route['kategori/(:any)/detail/(:any)/fasilitas'] = 'Kategori/fasilitas_wisata/$1/$2';
$route['kategori/(:any)/detail/(:any)/wahana'] = 'Kategori/wahana_wisata/$1/$2';
$route['kategori/(:any)/detail/(:any)/foto'] = 'Kategori/wisata_foto/$1/$2';
$route['kategori_produk/(:any)/detail/(:any)/foto'] = 'Kategori_produk/produk_foto/$1/$2';
$route['kategori/(:any)/detail/(:any)/pendukung'] = 'Kategori/fasilitas_pendukung/$1/$2';

$route['admin/level'] = 'User/user_level';
$route['admin/level/(:any)/privillage'] = 'User/all_menu/$1';
$route['admin/maintenance'] = 'Administrator/user_maintenance';

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

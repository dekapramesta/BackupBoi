<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['Artikel'] = 'Berita';
$route['Artikel/Tags/(:any)'] = 'Berita/tag_berita';
$route['Artikel/Kata-Kunci/(:any)'] = 'Berita/search';
$route['Artikel/(:any)/(:any)'] = 'Berita/berita_thn/$bln';
$route['Artikel/(:any)'] = 'Berita/detail_berita/$1';
$route['Penulis-Artikel/(:any)'] = 'Berita/detail_penulis/$1';
$route['Penulis-Wisata/(:any)'] = 'Wisata/detail_penulis/$1';
$route['Produsen-produk/(:any)'] = 'Produk/detail_produsen/$1';
$route['Penulis-Wisata/(:any)/(:num)'] = 'Wisata/detail_penulis/$1';
$route['Tempat-Wisata/(:num)'] = 'Wisata/index/$1';
$route['Tempat-Wisata'] = 'Wisata';
$route['Tentang-Kami'] = 'Tentang';
$route['Kontak-Kami'] = 'Kontak';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Tempat-Wisata/(:num)'] = 'Wisata';
$route['Tempat-Wisata/Kata-Kunci/(:any)/(:any)'] = 'Wisata/search_wisata';
$route['Tempat-Wisata/Kata-Kunci/(:any)'] = 'Wisata/search_wisata';
$route['Produk/Kata-Kunci/(:any)'] = 'Produk/search_produk';
$route['Tempat-Wisata/Tags/(:any)'] = 'Wisata/tag_wisata/$item';
$route['Produk/Tags/(:any)'] = 'Produk/tag_produk/$item';
$route['Tempat-Wisata/(:any)/(:any)/(:any)/(:num)'] = 'Wisata/wisata';
$route['Tempat-Wisata/(:any)/(:any)/(:any)/(:any)'] = 'Wisata/detail_wisata';
$route['Tempat-Wisata/(:any)/(:any)/(:any)'] = 'Wisata/wisata';
$route['Tempat-Wisata/(:any)/(:any)'] = 'Wisata/wisata';
$route['Tempat-Wisata/(:any)'] = 'Wisata/wisata';
$route['Produk/Semua-Jenis'] = 'Produk';
$route['Produk/Semua-Jenis/(:any)'] = 'Produk';
$route['Produk/Semua-Jenis/(:any)/(:any)'] = 'Produk';
$route['Produk/Semua-Jenis/(:any)/(:any)/(:any)'] = 'Produk';
$route['Produk/Jenis/(:any)'] = 'Produk/Jenis/$1';
$route['Produk/Jenis/(:any)/(:any)'] = 'Produk/Jenis/$1';
$route['Produk/Jenis/(:any)/(:any)/(:any)'] = 'Produk/Jenis/$1';
$route['Produk/Jenis/(:any)/(:any)/(:any)/(:any)'] = 'Produk/Jenis/$1';
$route['Produk/detail/(:any)/(:any)/(:any)'] = 'Produk/detail_produk';

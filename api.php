<?php
$db = new PDO('sqlite:database.sqlite');
header('Content-Type: application/json');
$routes = explode('/', $_SERVER['PATH_INFO']);
switch ($routes[1]) {
	case 'tampil':
		// tampil
		$hasil = $db->query('select * from biodata');
		$array_hasil = [];
		while ($row = $hasil->fetch()){
			$array_hasil[] = [
				'id' => $row['id'],
				'nama' => $row['nama'],
				'alamat' => $row['alamat']
			];
		}
		echo json_encode($array_hasil);
		break;
	case 'hapus':
		// hapus/:id
		$db->query('delete from biodata where id = ' . $routes[2]);
		break;
	case 'tambah':
		// tambah/:nama/:alamat
		$db->query('insert into biodata values (null, "' . $routes[2] . '", "' . $routes[3] . '")');
		break;
	case 'update':
		// update/:id/:nama/:alamat
		$db->query('update biodata set nama="' . $routes[3] . '", alamat="' . $routes[4] . '" where id=' . $routes[2]);
		break;
}
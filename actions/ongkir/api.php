<?php 
function tampil_provinsi()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 6e4bda689dc5a64b2e9cdc59edcf0680"
			),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) 
	{
		echo "cURL Error #:" . $err;
	} else 
	{
		$data_prov = json_decode($response,TRUE);
		return $data_prov['rajaongkir']['results'];
	}
}

function tampil_kota($id_provinsi)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$id_provinsi",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 6e4bda689dc5a64b2e9cdc59edcf0680"
			),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) 
	{
		echo "cURL Error #:" . $err;
	} 
	else 
	{
		$data_kota = json_decode($response,TRUE);
		return $data_kota['rajaongkir']['results'];
	}
}

function tampil_ongkir($id_kota_asal,$id_kota_tujuan,$nama_ekspedisi,$total_berat)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "origin=$id_kota_asal&destination=$id_kota_tujuan&weight=$total_berat&courier=$nama_ekspedisi",
		CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			"key: 6e4bda689dc5a64b2e9cdc59edcf0680"
			),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) 
	{
		echo "cURL Error #:" . $err;
	} 
	else 
	{
		$data_ogkir = json_decode($response,TRUE);
		return $data_ogkir['rajaongkir']['results']['0']['costs'];
	}
}


$prov = tampil_provinsi();
echo "<pre>";
print_r ($prov);
echo "</pre>";
echo "<hr>";

// tampil kota prov jogja
$kota = tampil_kota(5);
echo "<pre>";
print_r ($kota);
echo "</pre>";
echo "<hr>";


	// contoh ongkir sleman ke bandung
$ongkir = tampil_ongkir(419,23,'jne',1000);
echo "<pre>";
print_r ($ongkir);
echo "</pre>";


?>
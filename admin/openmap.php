<?php 
$tanggal=date("Y");
include "../koneksi.php";
session_start(); 
?>

<?php

 // Mendapatkan data latitude dan longitude dari tabel booking berdasarkan id_booking
 $id_booking = $_GET['id_booking'];
$sql = "SELECT latitude, longitude FROM booking WHERE id_booking = $id_booking";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // Data ditemukan, membaca titik koordinat
    $row = $result->fetch_assoc();
    $latitude = $row["latitude"];
    $longitude = $row["longitude"];

    // Membangun URL Google Maps
    $googleMapsUrl = "https://www.google.com/maps?q=" . $latitude . "," . $longitude;

    // Membuka Google Maps di tab baru
    echo "<script>window.open('$googleMapsUrl', '_blank');</script>";
} else {
    // Data tidak ditemukan
    echo "Data tidak ditemukan.";
}

// Menutup koneksi
$koneksi->close();
?>
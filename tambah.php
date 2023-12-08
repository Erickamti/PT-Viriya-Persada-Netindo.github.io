<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan variabel-variabel telah di-set sebelum digunakan
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $hp = isset($_POST['hp']) ? $_POST['hp'] : '';

    // Lakukan validasi data (tambahkan validasi sesuai kebutuhan)

    // Masukkan data ke database
    $sql = "INSERT INTO customer (nama, email, hp) VALUES ('$nama', '$email', '$hp')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dimasukkan ke database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    //kirim ke mail
    $isi=$nama.'('.$email.')';
    $to='eric@viriya.co.id';
    $body="<table>
            <tr>
                <td>".$hp."</td>
                </tr>
            </table>";
    $subject='email dari '.$nama;
    $headers= "From: ".$nama." \r\n";
    mail($to, $subject, $body,$headers);
}

?>

<html>
    <a href="index.html">Kembali ke beranda</a>
</html>
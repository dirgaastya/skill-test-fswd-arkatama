<!DOCTYPE html>
<html>

<head>
    <title>Form Input Data</title>
</head>

<body>
    <h2>Form Input Data</h2>
    <form method="post" action="">
        Masukkan data (Format: NAMA[spasi]USIA[spasi]KOTA): <input type="text" name="data">
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    function parseData($inputData)
    {
        $data = explode(" ", $inputData);
        $nama = "";
        $usia = "";
        $kota = "";

        $isNama = true;
        foreach ($data as $item) {
            if ($isNama) {
                if (is_numeric($item)) {
                    $isNama = false;
                    $usia = preg_replace('/[^0-9]/', '', $item);
                } else {
                    $nama .= $item . " ";
                }
            } else {
                $kota .= $item . " ";
            }
        }

        $nama = strtoupper(trim($nama));
        $kota = strtoupper(trim(str_replace(array('tahun', 'thn', 'th'), '', $kota)));
        return array('nama' => $nama, 'usia' => $usia, 'kota' => $kota);
    }

    if (isset($_POST['submit'])) {
        $inputData = $_POST['data'];

        $result = parseData($inputData);

        // Menghubungkan ke database MySQL
        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "skill_test";

        $connection = mysqli_connect($host, $username, $password, $database);

        // Cek koneksi
        if (!$connection) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        // Insert data ke database
        $nama = $result['nama'];
        $usia = $result['usia'];
        $kota = $result['kota'];

        $sql = "INSERT INTO data_pengguna (nama, usia, kota) VALUES ('$nama', '$usia', '$kota')";
        if (mysqli_query($connection, $sql)) {
            echo "Data berhasil disimpan di database.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        // Tutup koneksi
        mysqli_close($connection);
    }
    ?>
</body>

</html>

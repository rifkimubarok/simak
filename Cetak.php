<?php
class Cetak
{
    
    function cetak_kartu_uts($kode_jurusan,$tahun_angkatan,$awal,$akhir,$tahun_semester)
    {
        $url = "https://simak.unsil.ac.id/us-unsil/jur/uts.kartu.cetak.php"; // api untuk mencetak kartu
        $nomor = $tahun_angkatan.$kode_jurusan; // penggabungan kode jurusan dan 
        //pembuatan folder suai jurusan dan angkatan
        try{
            if(!file_exists($tahun_angkatan.$kode_jurusan."_uts")){
                mkdir($tahun_angkatan.$kode_jurusan."_uts");
            }
        }catch(Exception $e){

        }
        for ($i=$awal;$i<=$akhir;$i++){ // perulangan menggunakan for
            $no_induk = "000"; //digit nomor induk
            $npm = $nomor.substr($no_induk,0,strlen($no_induk)-strlen($i)).$i; //proccess menghasilkan NPM diambil dari tahun angkatan,kodejurusan+fakultas+digit nomor induk
            
            $file = fopen($tahun_angkatan.$kode_jurusan."_uts/".$npm.".pdf", 'w+'); //pembuatan file kosong


            //parameter api untuk cetak kartu
            $param = http_build_query(array(
                "gos"=>"CetakKHS",
                "BypassMenu"=>"1",
                "TahunID"=> $tahun_semester,
                "ProdiID"=>$kode_jurusan,
                "Angkatan"=>$tahun_angkatan,
                "MhswID"=>$npm
            ));


            //pengecekan jika file gagal di buat dan dibuka
            if($file === false){
                throw new Exception('Could not open: ' . $saveTo);
            }

            //memulai penginisialisasian api
            $ch = curl_init($url);

            //hasil api disimpan ke dalam file
            curl_setopt($ch, CURLOPT_FILE, $file);

            //Timeout if the file doesn't download after 20 seconds.
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param); //penyertaan parameter terhadap api
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //mematikan handshaking SSL

            //Execute the request.
            curl_exec($ch);

            //If there was an error, throw an Exception
            if(curl_errno($ch)){
                throw new Exception(curl_error($ch));
            }

            //Get the HTTP status code.
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            //Close the cURL handler.
            curl_close($ch);

            //Close the file handler.
            fclose($file);

            if($statusCode == 200){
                printf("  Kartu UTS $npm Berhasil Diunduh.\n");
            } else{
                echo "Status Code: " . $statusCode;
            }
        }
    }
    
    function cetak_kartu_uas($kode_jurusan,$tahun_angkatan,$awal,$akhir,$tahun_semester)
    {
        $url = "https://simak.unsil.ac.id/us-unsil/jur/uas.kartu.cetak.php"; // api untuk mencetak kartu
        $nomor = $tahun_angkatan.$kode_jurusan; // penggabungan kode jurusan dan 
        //pembuatan folder suai jurusan dan angkatan
        try{
            if(!file_exists($tahun_angkatan.$kode_jurusan."_uas")){
                mkdir($tahun_angkatan.$kode_jurusan."_uas");
            }
        }catch(Exception $e){

        }
        for ($i=$awal;$i<=$akhir;$i++){ // perulangan menggunakan for
            $no_induk = "000"; //digit nomor induk
            $npm = $nomor.substr($no_induk,0,strlen($no_induk)-strlen($i)).$i; //proccess menghasilkan NPM diambil dari tahun angkatan,kodejurusan+fakultas+digit nomor induk
            
            $file = fopen($tahun_angkatan.$kode_jurusan."_uas/".$npm.".pdf", 'w+'); //pembuatan file kosong


            //parameter api untuk cetak kartu
            $param = http_build_query(array(
                "gos"=>"CetakKHS",
                "BypassMenu"=>"1",
                "TahunID"=> $tahun_semester,
                "ProdiID"=>$kode_jurusan,
                "Angkatan"=>$tahun_angkatan,
                "MhswID"=>$npm
            ));


            //pengecekan jika file gagal di buat dan dibuka
            if($file === false){
                throw new Exception('Could not open: ' . $saveTo);
            }

            //memulai penginisialisasian api
            $ch = curl_init($url);

            //hasil api disimpan ke dalam file
            curl_setopt($ch, CURLOPT_FILE, $file);

            //Timeout if the file doesn't download after 20 seconds.
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param); //penyertaan parameter terhadap api
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //mematikan handshaking SSL

            //Execute the request.
            curl_exec($ch);

            //If there was an error, throw an Exception
            if(curl_errno($ch)){
                throw new Exception(curl_error($ch));
            }

            //Get the HTTP status code.
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            //Close the cURL handler.
            curl_close($ch);

            //Close the file handler.
            fclose($file);

            if($statusCode == 200){
                printf("  Kartu UAS $npm Berhasil Diunduh.\n");
            } else{
                echo "Status Code: " . $statusCode;
            }
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function cetak_khs($kode_jurusan,$tahun_angkatan,$awal,$akhir)
    {
        $url = "https://simak.unsil.ac.id/us-unsil/mhsw/transkrip.khs.php"; // api untuk mencetak kartu
        $nomor = $tahun_angkatan.$kode_jurusan; // penggabungan kode jurusan dan 
        //pembuatan folder suai jurusan dan angkatan
        try{
            if(!file_exists($tahun_angkatan.$kode_jurusan."_khs")){
                mkdir($tahun_angkatan.$kode_jurusan."_khs");
            }
        }catch(Exception $e){

        }
        for ($i=$awal;$i<=$akhir;$i++){ // perulangan menggunakan for
            $no_induk = "000"; //digit nomor induk
            $npm = $nomor.substr($no_induk,0,strlen($no_induk)-strlen($i)).$i; //proccess menghasilkan NPM diambil dari tahun angkatan,kodejurusan+fakultas+digit nomor induk
            
            $file = fopen($tahun_angkatan.$kode_jurusan."_khs/".$npm.".pdf", 'w+'); //pembuatan file kosong


            //parameter api untuk cetak kartu
            $param = http_build_query(array(
                "_rnd"=>$this->generateRandomString(8),
                "MhswID"=>$npm
            ));

            //pengecekan jika file gagal di buat dan dibuka
            if($file === false){
                throw new Exception('Could not open: ' . $saveTo);
            }

            //memulai penginisialisasian api
            $ch = curl_init($url."?".$param);

            //hasil api disimpan ke dalam file
            curl_setopt($ch, CURLOPT_FILE, $file);

            //Timeout if the file doesn't download after 20 seconds.
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $param); //penyertaan parameter terhadap api
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //mematikan handshaking SSL

            //Execute the request.
            curl_exec($ch);

            //If there was an error, throw an Exception
            if(curl_errno($ch)){
                throw new Exception(curl_error($ch));
            }

            //Get the HTTP status code.
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            //Close the cURL handler.
            curl_close($ch);

            //Close the file handler.
            fclose($file);

            if($statusCode == 200){
                printf("  Kartu Hasil Studi $npm Berhasil Diunduh.\n");
            } else{
                echo "Status Code: " . $statusCode;
            }
        }
    }

    public function input_data($menu)
    {
        echo "  Masukan kodejurusan (7006)\t: ";
        $input_kodejurusan =  trim(fgets(STDIN));
        echo "  Masukan Tahun Angkatan (17)\t: ";
        $input_angkatan =  trim(fgets(STDIN));
        echo "  Masukan nomor awal (1)\t: ";
        $input_awal =  trim(fgets(STDIN));
        echo "  Masukan nomor akhir (10)\t: ";
        $input_akhir =  trim(fgets(STDIN));
        echo "  Masukan Tahun Semester (20181): ";
        $input_tahun_semester =  trim(fgets(STDIN));


        $kode_jurusan = $input_kodejurusan; //Kode jurusan
        $tahun_angkatan = $input_angkatan; //Tahun angkatan 2 digit
        $awal = $input_awal; // dimulai dari npm berapa, misal 1
        $akhir = $input_akhir; // akhir npm , misal 20
        if(intval($menu) != 3 ){
            $tahun_semester = $input_tahun_semester; // Semester tahun , misal 20181 diama 2018 sebagai tahun, 1 sebagai semester
        }
        switch ($menu) {
            case 1:
                $this->cetak_kartu_uts($kode_jurusan,$tahun_angkatan,$awal,$akhir,$tahun_semester);
                break;
            case 2:
                $this->cetak_kartu_uas($kode_jurusan,$tahun_angkatan,$awal,$akhir,$tahun_semester);
                break;
            case 3:
                $this->cetak_khs($kode_jurusan,$tahun_angkatan,$awal,$akhir);
                break;
            default:
                exit;
                break;
        }
    }

    public function show_menu()
    {
        $status = true;
        while($status){
            printf("|==========================================|\n");
            printf("|  Selamat Datang di Aplikasi Cetak Kartu  |\n");
            printf("|==========================================|\n");
            printf("  Menu Tersedia : \n");
            printf("  1. Cetak Kartu UTS \n");
            printf("  2. Cetak Kartu UAS \n");
            printf("  3. Cetak Kartu Hasil Studi \n");
            printf("  4. Keluar \n");
            printf("|==========================================|\n");
            printf("  Silahkan Pilih Menu : ");
            $menu =  trim(fgets(STDIN));
            switch ($menu) {
                case 1:
                    $this->input_data($menu);
                    break;
                case 2:
                    $this->input_data($menu);
                    break;
                case 3:
                    $this->input_data($menu);
                    break;
                case 4:
                    printf("Terimasih Sudah Menggunakan Aplikasi.\n");
                    $status = false;
                    break;
                default:
                    printf("Anda Memasukan pilihan yang tidak ada\n");
                    break;
            }

            printf("\n\n\n   Apakah Ingin Generate Lagi ?(y/n)");
            $menu =  trim(fgets(STDIN));
            if(strtolower($menu) == "y"){
                $status = true;
            }else{
                $status = false;
            }
        }
    }
}

$cetak = new Cetak();
$cetak->show_menu();


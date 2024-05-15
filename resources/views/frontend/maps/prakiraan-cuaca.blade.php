<?php
$code = array("Banda Aceh","Serang","Bengkulu","Yogyakarta","Jakarta","Jambi","Bandung","Semarang","Surabaya","Malang","Pontianak","Palangkaraya","Pangkal Pinang","Tanjung Pinang","Lampung","Pekan Baru","Padang","Palembang","Medan","Denpasar","Gorontalo","Banjarmasin","Samarinda","Tanjung Selor","Mataram","Kupang","Mamuju","Makassar","Palu","Kendari","Manado","Ambon","Sofifi","Jayapura","Manokwari");
$coro = array("Banda Aceh","Yogyakarta","Jakarta","Bandung","Surabaya","Palangkaraya","Pekan Baru","Padang","Palembang","Medan","Denpasar","Banjarmasin","Mataram","Kupang","Makassar","Palu","Jayapura","Manokwari");
?>

@extends('layouts.scaffold')

@section('js-filters')
    d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
    <script type="text/javascript">
        formRules = {
            judul: ['empty'],
        };

    </script>
@endsection

@section('css')
    <style>
        .outer-top {
            margin-top: 188px;
        }

        @media only screen and (max-width: 768px) {
            .outer-top {
                margin-top: 387px;
            }
        }


        .multi-item-carousel {
            .carousel-inner {
                >.item {
                    transition: 500ms ease-in-out left;
                }

                .active {
                    &.left {
                        left: -33%;
                    }

                    &.right {
                        left: 33%;
                    }
                }

                .next {
                    left: 33%;
                }

                .prev {
                    left: -33%;
                }

                @media all and (transform-3d),
                (-webkit-transform-3d) {
                    >.item {
                        // use your favourite prefixer here
                        transition: 500ms ease-in-out left;
                        transition: 500ms ease-in-out all;
                        backface-visibility: visible;
                        transform: none !important;
                    }
                }
            }

            .carouse-control {

                &.left,
                &.right {
                    background-image: none;
                }
            }
        }

        // non-related styling:
        body {
            background: #333;
            color: #ddd;
        }

        h1 {
            color: black;
            font-size: 2.25em;
            text-align: center;
            margin-top: 1em;
            margin-bottom: 1em;
            /* text-shadow: 0px 2px 0px rgba(0, 0, 0, 1); */
        }
        h2 {
            color: black;
            font-size: 1.50em;
            text-align: center;
            margin-top: 1em;
            margin-bottom: 2em;
        }

    </style>
@endsection

@section('content-frontend')
    <?php if (isset($_GET['city'])) {
    $urlDK = 'http://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] .
    '&appid=51bb74777dae58cb1371706d5e6470cf&units=metric&lang=id';
    $chDK = curl_init();
    curl_setopt($chDK, CURLOPT_HEADER, 0);
    curl_setopt($chDK, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($chDK, CURLOPT_URL, $urlDK);
    curl_setopt($chDK, CURLOPT_VERBOSE, 0);
    curl_setopt($chDK, CURLOPT_SSL_VERIFYPEER, false);

    $dataDK = curl_exec($chDK);
    curl_close($chDK);
    $data = json_decode($dataDK);
    // print_r($dataDK);
    } ?>
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i
            class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
    <div class="body-content">
        {{-- <div id="GoogleMap" style="width:100%;height:500px"></div> --}}
        <h1>Prakiraan Cuaca <?php echo (isset($data)) ? $data->name : '' ?></h1>
    </div>
    <div class="container" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-12">
                {{-- <h1>Prakiraan Cuaca</h1> --}}
                {{-- <input type="text" id="city">
                <button id="getWeatherForcast">Get</button>
                <div id="showWeatherForcast"></div> --}}

                <form method="GET">
                    <div class="col-md-10" style="text-align: center;margin-top: 20px">
                        <select class="form-control" style="max-width:100%;margin-bottom: 10px;margin-left: 30px" name="city" id="">
                            <option value="" disabled selected>
                                Pilih Wilayah
                            </option>
                            @foreach ($code as $item)
                            <option value="{{ $item }}">
                                {{ $item }}
                            </option>
                            @endforeach
                            
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                         <input type="submit" style="margin-bottom: 10px;margin-left: 20px;margin-top: 20px" class="btn btn-success"
                            value="FILTER">
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if(isset($_GET['city']))
    <div class="container" style="margin-bottom: 50px">
        <div class="row">
            <div class="col-12">
                <div style="width: 100%; height: 500px;background-image: url({{ asset('img/bg.jpg') }});">
                    <div class="row">
                        <div class="col">
                            <h1>{{ $data->name }}</h1>
                        <h2><img style="width: 10%" src="http://openweathermap.org/img/wn/{{ $data->weather[0]->icon }}.png" alt=""></h2>
                        <h2>{{ $data->weather[0]->main }}</h2>
                        <h2>{{  ucwords($data->weather[0]->description, " ") }}</h2>
                        
                        <h1>{{ $data->main->temp }} &deg;C</h1>
                        <h2>{{ $data->main->temp_min  }} &deg;C - {{ $data->main->temp_max  }} &deg;C </h2>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-md-12">
                <div class="carousel slide multi-item-carousel" id="theCarousel">
                    <div class="carousel-inner" style="background-image: url({{ asset('img/bg.jpg') }})">
                        <?php 
                        $active = 0;
                        foreach ($coro as  $value) {
                          $active ++;
                            $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $value .
                            '&appid=51bb74777dae58cb1371706d5e6470cf&units=metric&lang=id';
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_VERBOSE, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                            $dataCoro = curl_exec($ch);
                            curl_close($ch);
                            $data1 = json_decode($dataCoro);
                            // print_r($data);
                            
                            // dd($data1);
                            ?>
                        <div class="item <?php echo ($active == 1) ? 'active' : '' ?>">
                            <div class="col-xs-4" ><a href="#1"> </a>
                                        <div >
                                            <h1>{{ $data1->name }}</h1>
                                            <h2><img style="width: 20%" src="http://openweathermap.org/img/wn/{{ $data1->weather[0]->icon }}.png" alt=""></h2>
                                            <h2>{{ $data1->weather[0]->main }}</h2>
                                            <h2>{{  ucwords($data1->weather[0]->description, " ") }}</h2>
                                            
                                            <h1>{{ $data1->main->temp }} &deg;C</h1>
                                            <h2>{{ $data1->main->temp_min  }} &deg;C - {{ $data1->main->temp_max  }} &deg;C </h2>
                                            <h2>{{ date("l, d M Y")  }} </h2>
                                        </div>
                                    </div>
                                        
                        </div>
                        <?php } ?>
                        
                        
                        

                        <!--  Example item end -->
                    </div>
                    <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i
                            class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#theCarousel" data-slide="next"><i
                            class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endif


    <div class="container" style="margin-bottom: 50px">
        <div class="row">
            
            <div class="col-md-8">
                <h3>Bencana Alam – Pengertian, Macam, Penyebab & Penanggulangan</h3><hr>
                <p>Berada di wilayah ring of fire atau tepatnya cincin api 
                    pasifik, membuat Indonesia memiliki wilayah yang subur dan kaya akan hasil bumi. Namun 
                    dibalik itu, Indonesia juga harus mewaspadai berbagai macam bencana alam yang risiko terjadinya 
                    sangat tinggi. Mulai dari letusan gunung berapi, tsunami, gempa bumi, dan lain sebagainya.</p>
                    <p>
                        Sistem prediksi dan penanggulangan bencana saat ini telah memanfaatkan perkembangan 
                        teknologi, antara lain dengan alat pendeteksi tsunami yang dipasang di lepas pantai wilayah tertentu, serta alat pendeteksi banjir yang ditemukan baru-baru ini.
                    </p>
                    <p>
                        Tujuannya adalah untuk memberi peringatan dini terutama kepada warga pesisir agar dapat melakukan upaya penyelamatan diri. 
                        Selain itu, spesifikasi bangunan-bangunan juga harus tahan terhadap goncangan gempa.
                    </p>
                <h3>Pengertian Bencana Alam</h3>
                <p>
                    Bencana adalah suatu peristiwa atau rangkaian peristiwa yang mengancam 
                    dan mengganggu kehidupan serta penghidupan yang diakibatkan oleh faktor 
                    alam dan atau manusia sehingga menimbulkan korban jiwa, kerusakan lingkungan, 
                    kerugan materi dan dampak psikologis.
                </p>
                <p>
                    Sedangkan, bencana alam adalah bencana yang disebabkan oleh peristiwa atau rangkaian peristiwa alam. Peristiwa alam sebagai penyebab bencana tersebut tentu tidak dapat kita cegah, 
                    namun dapat kita prediksi dan antisipasi untuk meminimalisir kerugian dan korban.
                </p>
                <h3>
                    Berbagai Macam Bencana Alam
                </h3>
                <h3>1. Gempa Bumi</h3>
                <p>
                    Seperti yang telah disinggung sebelumnya, wilayah Indonesia berada wilayah ring of fire. Wilayah Indonesia berada pada pertemuan 3 lempeng utama dunia, yaitu Indo-Australia, 
                    Eurasia dan Lempeng Pasifik sehingga potensi untuk terjadi bencana gempa bumi sangat tinggi sekali.
                </p>
                <p>
                    Gempa bumi adalah guncangan atau getaran yang terjadi pada permukaan bumi akibat pelepasan energi akibat pergerakan atau pergesekan lempeng / kerak bumi. 
                    Guncangan atau getaran tersebut menciptakan gelombang seismik.
                </p>
                <img style="width: 100%" src="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1080/https://rimbakita.com/wp-content/uploads/2018/12/bangunan-runtuh.jpg" alt=""><br>
                <p>
                    Untuk memantau besaran gempa bumi yang terjadi maka dipergunakan alat yang bernama seismograf dengan menggunakan skala Moment Magnitudo. 
                    Besaran lokal 5 magnitude disebut dengan Skala Richter.
                </p>
                <p>
                    Gempa bumi tidak dapat diperkirakan kapan terjadi. Perkiraan yang dapat diperoleh adalah kisaran atau besaran gempa yang akan terjadi. Pada gempa bumi yang berpusat di wilayah laut, dapat menimbulkan bencana lain berupa potensi tsunami. Oleh karena itu, dengan perkembangan teknologi saat ini telah diciptakan 
                    alat-alat pendeteksi tsunami yang diletakkan ditengah samudra atau pesisir.
                </p>
                <h3>
                    2. Tsunami
                </h3>
                <p>
                    Tsunami dapat dipicu oleh gempa bumi yang berpusat ditengah laut, longsoran dasar laut, letusan gunung berapi bawah laut, dan hantaman meteor di laut.

Secara harfiah, arti kata tsunami adalah “ombak besar di pelabuhan”, yaitu peristiwa perpindahan badan air yang disebabkan oleh perubahan permukaan laut secara vertikal secara tiba-tiba. 
Tsunami berasal dari kata dalam bahasa Jepang, “tsu” = pelabuhan dan “nami” = gelombang.
                </p>
                <p>
                    Sama halnya seperti gempa bumi, bencana tsunami tidak dapat diprediksi. Meskipun saat ini telah ada alat pendeteksi tsunami, sifat dari alat tersebut hanya sebagai 
                    peringatan karena tsunami datang dengan kecepatan tinggi dan waktu yang cepat.
                </p>
                <h3>3. Banjir</h3>
                <p>
                    Curah hujan yang tinggi pada musim penghujan umumnya menjadi penyebab banjir. Bencana banjir biasanya diperparah oleh faktor manusia, dimana saluran air sungai yang tidak memadai sehingga air meluap ke pemukiman dan hilangnya area resapan air ke tanah.

Selain itu, deforestasi hutan yang semakin parah juga memperburuk keadaan. Oleh karena itu, gerakan reboisasi harus terus diupayakan agar alam kembali seimbang.
                </p>
                <p>
                    Namun pada daerah tertentu seperti Jakarta, cara alternatif untuk mengatasi curah hujan tinggi adalah dengan membuat sumur resapan. Pembuatan sumur resapan diharapkan dapat membantu 
                    penyerapan air ke dalam tanah sehingga tidak menggenangi area dengan risiko banjir.
                </p>
                <h3>
                    4. Tanah Longsor
                </h3>
                <p>
                    Tanah longsor adalah peristiwa geologi berupa gerakan masa tanah atau batuan dengan berbagai jenis dan tipe, seperi jatuhnya bebatuan dan gumpalan tanah yang besar.
                </p>
                <p>
                    Bencana tanah longsor dapat disebabkan oleh dua faktor yaitu faktor pendorong dan pemicu. Faktor pendorong ialah faktor-faktor yang mempengaruhi kondisi material longsor. 
                    Sedangkan faktor pemicu adalah faktor penyebab gerakan dari material longsor.
                </p>
                <p>
                    Peristiwa longsor umumnya terjadi di lereng-lereng bukit atau pegunungan dengan posisi daratan miring. Pemicunya antara lain 
                    curah hujan yang lebat dan diperparah dengan gundulnya hutan atau pepohonan akibat deforestasi.
                </p>
                <p>
                    Selain itu, tanah longsor juga dapat terjadi secara alami, misalnya dikarenakan kondisi
                     tanah yang kurang padat disertai hujan lebat dan kondisi kemiringan yang curam.
                </p>
                <h3>
                    5. Gunung Meletus
                </h3>
                <p>
                    Masih berkaitan dengan wilayah cincin api yang berada di Indonesia, hal ini menyebabkan Indonesia memiliki banyak gunung
                     berapi aktif seperti gunung anak krakatau, gunung merapi, gunung sinabung, dan lainnya.
                </p>
                <p>
                    Meletusnya gunung dapat terjadi karena endapan magma dalam perut bumi yang terdorong oleh gas bertekanan tinggi sehingga menyebabkan letusan. Status aktivitas gunung berapi 
                    dibagi menjadi kategori siaga, waspada, awas dan puncaknya adalah kategori meletus.
                </p>
                <p>
                    Gunung berapi yang meletus akan memuntahkan berbagai macam material seperti debu, batu, kerikil, magma, dan awan panas dari dalam perut bumi. Magma (ketika telah keluar disebut lava) yang dihasilkan dari letusan 
                    gunung memiliki suhu sangat panas hingga mencapai lebih dari 1.000 derajat celcius.
                </p>
                <p>
                    Meski digolongkan pada peristiwa bencana, ternyata letusun gunug berapi juga memberi manfaat bagi manusia, hewan, dan tumbuhan. Hasil letusan akan memberikan kesuburan bagi tanah dan material 
                    vulkanik seperi pasir dan batu sangat bermanfaat untuk bahan dasar bangunan.
                </p>
                <h3>6. Kebakaran Hutan</h3>
                <p>
                    Terbakarnya hutan dapat terjadi baik secara alami atau karena faktor manusia. Kebakaran hutan secara alami dapat disebabkan oleh masa kemarau yang terlampau panjang dan suhu panas yang ekstrem. Sedangkan, faktor dari manusia salah 
                    satunya karena kebutuhan ekonomi seperti pembukaan lahan hutan untuk perkebunan sawit.
                </p>
                <img style="width: 100%" src="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1080/https://rimbakita.com/wp-content/uploads/2018/11/kebakaran-hutan.jpg" alt=""><br>
                <p>
                    Kebakaran hutan terparah di Indonesia terjadi pada tahun 1997 – 1998 disebabkan oleh oknum-oknum tidak bertanggungjawab. Selain merusak lingkungan, negara tetangga seperti Malaysia, Brunei, Thailand, 
                    Singapura, dan Vietnam juga terkena imbas polusi udara dari asap kebakaran.
                </p>
                <h3>Sistem Penanggulangan Bencana</h3>
                <p>Sejak bencana tsunami Aceh pada 2004, pemerintah Indonesia mulai berbenah dalam menghadapi dan menangani bencana alam. 
                    Adapun upaya yang telah dilakukan oleh pemerintah, sebagai berikut:
                </p>
                <p>
                    1. Legislasi – Pemerintah Indonesia bersama dengan DPR telah mengesahkan Undang-Undang Nomor 24 Tahun 2007 Tentang Penanggulangan Bencana. Selain itu juga ada beberapa produk hukum, seperti Peraturan Pemerintah , 
                    Peraturan Presiden, Peraturan Kepala Kepala Badan, serta peraturan daerah terkait bencana alam.
                </p>
                <p>
                    2. Kelembagaan – Kelembagaan dapat dibagi menjadi formal dan non formal. Secara formal, Badan Nasional Penanggulangan Bencana (BNPB) lembaga resmi negara untuk menanggulangi masalah bencana. 
                    Kemudian Badan Penanggulangan Bencana Daerah (BPBD) yang bekerja pada tingkat provinsi.
                </p>
                <p>
                    3. Pendanaan – Berikut ini adalah beberapa sumber pendanaan yang dapat digunakan untuk membantu masalah bencana di Indonesia : Dana DIPA (APBN/APBD), Dana Kontijensi, Dana On-Call, Dana Bantuan Sosial Berpola Hibah, 
                    Dana yang bersumber dari masyarakat, Dana dukungan komunitas internasional.
                </p>
                <img style="width: 100%" src="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_1080/https://rimbakita.com/wp-content/uploads/2018/12/dampak-tsunami.jpg" alt=""><br>
                <h3>Bencana Alam Dahsyat di Indonesia</h3>
                <p>
                    1. Tsunami Aceh (2004) dengan total korban lebih dari 220.000 jiwa warga Indonesia
                </p>
                <p>
                    2. Letusan Gunung Tambora (1815) dengan total korban lebih dari 92.000 jiwa
                </p>
                <p>
                    3. Letusan Gunung Krakatau (1883) dengan total korban lebih 36.000 jiwa
                </p>
                <p>
                    4. Letusan Gunung Agung (1963) dengan total korban lebih dari 15.000 jiwa
                </p>
                <p>
                    5. Gempa Yogyakarta (2006) dengan total korban lebih dari 6.000 jiwa
                </p>
                <p>
                    6. Letusan Gunung Kelud (1919) dengan total korban lebih dari 5.000 jiwa
                </p>
                <p>
                    7. Tsunami Flores (1992) dengan total korban lebih dari 2.000 jiwa
                </p>
                <p>
                    8. Letusan Gunung Merapi (1930) dengan total korban lebih dari 1.300 jiwa
                </p>
                <p>
                    9. Gempa Sumatera Barat (2009) dengan total korban lebih dari 1.100 jiwa
                </p>
                <p>
                    10. Gempa Lombok (2018) dengan total korban lebih dari 500 jiwa
                </p>
                <p>
                    11. Gempa Palu (2018) dengan total korban lebih dari 2.000 jiwa
                </p>
                <p>
                    12. Tsunami Selat Sunda (2018) dengan total korban lebih dari 300 jiwa
                </p><hr><br><br>
                <p><b>Sumber Artikel : </b><a href="https://rimbakita.com/bencana-alam/">https://rimbakita.com/bencana-alam/</a></p>
            </div>
            <div class="col-md-4">
                <h4>Gempa Bumi Terkini</h4><hr>
                <?php 
                $url = "https://data.bmkg.go.id/autogempa.xml";
                $sUrl = file_get_contents($url, False);
                $xml = simplexml_load_string($sUrl);

                    
                    ?>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{ $xml->gempa->Tanggal }}, {{ $xml->gempa->Jam }}</h4>
                            </div>
                            <div class="col-md-6">
                                <img style="width: 100%" src="https://data.bmkg.go.id/eqmap.gif" alt="" >

                            </div>
                            <div class="col-md-6">
                                
                                <h5>Magnitudo</h5>
                                <h4>{{ $xml->gempa->Magnitude }}</h4>
                                <h5>Kedalaman</h5>
                                <h4>{{ $xml->gempa->Kedalaman }}</h4>
                                <h5>Lokasi</h5>
                                <h4>{{ $xml->gempa->Lintang }} - {{ $xml->gempa->Bujur }}</h4>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{ $xml->gempa->Wilayah1 }}</h4>
                                <h4>{{ $xml->gempa->Potensi }}</h4><br>
                                <h5><b>Sumber Data : </b>BMKG (Badan Meteorologi, Klimatologi, dan Geofisika)</h5>
                                <h5><b>Sumber Link : </b><a href="https://www.bmkg.go.id/">https://www.bmkg.go.id/</a></h5>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15%">
                            <div class="col-md-12">
                                <h4>Video</h4><hr>
                                <iframe style="width: 100%" height="300" src="https://www.youtube.com/embed/4sV215IHLJw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <h4>Evakuasi Bencana Longsor</h4>
                            </div>
                        </div>
                        
                
            </div>
        </div>
    </div>

    
@endsection

@section('scripts')
    <script>
        navigator.geolocation.getCurrentPosition(position => {
            localCoord = position.coords;
            window.apiUrl =
                `/api/cari-lokasi-terdekat?lat=${localCoord.latitude}&lng=${localCoord.longitude}&type=restaurant`;
            window.mapIcon = "{{ asset('img/rsz_loggo.png') }}";
            
        });

    </script>
    <script src="{{ asset('js/maps-init.js') }}"></script>

    <script type="text/javascript">
        


        // Instantiate the Bootstrap carousel
        $('.multi-item-carousel').carousel({
            interval: false
        });

        // for every slide in carousel, copy the next slide's item in the slide.
        // Do the same for the next, next item.
        $('.multi-item-carousel .item').each(function() {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            if (next.next().length > 0) {
                next.next().children(':first-child').clone().appendTo($(this));
            } else {
                $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
            }
        });

    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script>
@endsection

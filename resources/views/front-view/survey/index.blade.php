@extends('front-view.layouts.app')

@push('styles')

<style>

 .toggle-wrapper {
  position: relative;
  width: 110px;
  height: 40px;
  background: #f0f0f3;
  border-radius: 40px;
  box-shadow: inset 4px 4px 6px #ccc, inset -4px -4px 6px #fff;
  display: flex;
  align-items: center;
  padding: 4px;
  cursor: pointer;
}

.toggle-indicator {
  position: absolute;
  width: 48px;
  height: 32px;
  background-color: #ffffff;
  border-radius: 30px;
  top: 4px;
  left: 4px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 2px 2px 4px #bbb, -2px -2px 4px #fff;
}

.toggle-wrapper.active .toggle-indicator {
  left: 58px;
}

.toggle-labels {
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0 10px;
  z-index: 1;
}

.toggle-labels span {
  font-weight: bold;
  font-size: 12px;
  color: #555;
}

.toggle-indicator img {
  width: 18px;
  height: 18px;
}

.toggle-indicator small {
  font-size: 10px;
  margin-left: 4px;
}
</style>
@endpush

@section('content')
<div id="header_in">
    <a href="#0" class="close_in"><i class="pe-7s-close-circle"></i></a>
</div>

<div class="wrapper_in">
    <div class="container-fluid">
        <div class="tab-content">
            <div class="tab-pane fade" id="tab_1">
                <div class="subheader" id="quote"></div>
                <div class="row">
                    <aside class="col-xl-3 col-lg-4">
                        <h2>Yuk, Pilih Desain Baju Favoritmu!</h2>
                        <p class="lead">Berikan kami preferensi desain Anda, dan kami akan bantu wujudkan dengan harga terbaik.</p>
                    </aside><!-- /aside -->

                    <div class="col-xl-9 col-lg-8">
                        <div id="wizard_container">
                            <div id="top-wizard">
                                <strong>Progress</strong>
                                <div id="progressbar"></div>
                            </div><!-- /top-wizard -->

                            <form action="{{ route('user-selections.store') }}" method="POST">
                                @csrf

                                <div id="middle-wizard">
                                    <div class="step">
                                        <h3 class="main_question"><strong>1/9</strong> Data Diri</h3>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Tuliskan nama kamu" required>
                                        </div>
                                        <div class="form-group">
                                            <select name="birth_year" class="form-control" required>
                                                <option value="">Pilih tahun lahir anda</option>
                                                @for ($year = 1970; $year <= 2025; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="step">
                                        <h3 class="main_question"><strong>2/9</strong>Jenis Baju</h3>

                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-1.png') }}" alt="" class="img-fluid">
                                                        <input name="shirt_type" type="radio" value="Boxie Fit" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-2.png') }}" alt="" class="img-fluid">
                                                        <input name="shirt_type" type="radio" value="Oversize" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-3.png') }}" alt="" class="img-fluid">
                                                        <input name="shirt_type" type="radio" value="Regular Fit" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <h3 class="main_question">Size Baju</h3>
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size M
                                                        <input name="shirt_size" type="radio" value="M" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size L
                                                        <input name="shirt_size" type="radio" value="L" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size XL
                                                        <input name="shirt_size" type="radio" value="XL" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size XXL
                                                        <input name="shirt_size" type="radio" value="XXL" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /step 2-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>3/9</strong> Pilih Kategori Desain</h3>

                                        <div class="row justify-content-center">
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/strategy/jenis-desain-1.png') }}" alt="" class="img-fluid">
                                                        <input name="design_category" type="radio" value="Street Grit" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/strategy/jenis-desain-2.png') }}" alt="" class="img-fluid">
                                                        <input name="design_category" type="radio" value="Dark Art" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/strategy/jenis-desain-3.png') }}" alt="" class="img-fluid">
                                                        <input name="design_category" type="radio" value="Modern Myth" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/strategy/jenis-desain-4.png') }}" alt="" class="img-fluid">
                                                        <input name="design_category" type="radio" value="Quots Streetwear" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/strategy/jenis-desain-5.png') }}" alt="" class="img-fluid">
                                                        <input name="design_category" type="radio" value="Asian Art Fusion" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="step">
                                        <h3 class="main_question"><strong>4/9</strong>Pilih Design Baju dari Category (Street Grit Aesthetic)</h3>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img id="mainImage" src="{{ asset('asset/strategy/resurge-belakang-jenis-1.png') }}" alt="" class="img-fluid mb-3">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/resurge-belakang-jenis-1.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/resurge-depan-jenis-1.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/resurge-belakang-jenis-1.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>RESURGE 2025</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Desain RESURGE 2025 cocok buat lo yang pernah jatuh, tapi gak pernah habis.</p>
                                                <p class="mb-3">Ilustrasi tengkorak berapi biru ini bukan cuma keren—tapi penuh makna: Lo bukan sekadar kembali. Lo bangkit untuk balas dendam.</p>
                                                <p class="mb-3">Dengan nuansa streetwear yang tajam dan mencolok, desain ini cocok banget buat lo yang suka tampil beda, nyala, dan punya aura rebel. Warna biru terang & elemen kawat berduri bikin kesan “liar tapi stylish” makin kerasa.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="resurge_2025" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="resurge_2025">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img src="{{ asset('asset/strategy/nomercy-belakang-jenis-1.png') }}" alt="" class="img-fluid mb-3 mainImage">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/nomercy-belakang-jenis-1.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/nomercy-depan-jenis-1.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/nomercy-depan-jenis-1.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>NO MERCY</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Desain kaos "NO MERCY" cocok banget buat lo yang nggak suka main aman. Lo yang penuh taktik, berani ambil risiko, dan siap ambil alih semua permainan. Tengkorak mahkota dan kartu As bukan cuma dekorasi—itu lambang kekuasaan dan keberanian.</p>
                                                <p class="mb-3">Dengan nuansa streetwear yang bold dan berkarakter, desain ini pas banget buat lo yang tampil percaya diri, dominan, dan nggak takut terlihat beda.</p>
                                                <p class="mb-3">Warna emas, hitam, dan detail kartu bikin tampilannya kelihatan tajam dan powerful.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="no_mercy" value="true">


                                                <div class="toggle-wrapper" id="likeToggle" data-name="no_mercy">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                    </div><!-- /step 4-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>5/9</strong>Pilih Design Baju dari Category (Dark Art)</h3>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img id="mainImage" src="{{ asset('asset/strategy/flower-belakang-jenis-2.png') }}" alt="" class="img-fluid mb-3">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/flower-belakang-jenis-2.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/flower-depan-jenis-2.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/flower-belakang-jenis-2.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>FLOWER OF SNAKE</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Desain kaos “FLOWER OF SNAKE” adalah perwujudan dari kontras: keindahan yang menyengat, dan bahaya yang tersembunyi di balik diam. Ular dan bunga bukan cuma ornamen—mereka simbol kekuatan yang dibungkus elegansi. Desain ini cocok banget buat kamu yang kalem di luar tapi tajam di dalam.</p>
                                                <p class="mb-3">Dengan kombinasi warna merah menyala, hitam pekat, dan garis tradisional ala Jepang, desain ini bikin penampilan lo makin kuat, berkelas, dan beda sendiri di keramaian.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="flower_of_snake" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="flower_of_snake">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img src="{{ asset('asset/strategy/gordon-belakang-jenis-2.png') }}" alt="" class="img-fluid mb-3 mainImage">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/gordon-belakang-jenis-2.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/gordon-belakang-jenis-2.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/gordon-belakang-jenis-2.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>GORGON – MEDUSA</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Desain kaos "GORGON" terinspirasi dari sosok Medusa—simbol kekuatan wanita yang sering disalahpahami. Medusa bukan monster, tapi gambaran dari kekuatan yang dibungkam. Dengan rambut ular dan tatapan mematikan, desain ini cocok buat kamu yang punya karakter kuat, tajam, dan nggak bisa dianggap remeh.</p>
                                                <p class="mb-3">Dengan visual monokrom yang kuat dan elemen oranye mencolok, desain ini punya aura misterius tapi tetap streetwear-ready. Pas banget buat lo yang suka tampil beda tapi penuh makna dan tetap stylish di jalanan.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="gordon" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="gordon">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                    </div><!-- /step 5-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>6/9</strong>Pilih Design Baju dari Category (Modern Myht)</h3>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img id="mainImage" src="{{ asset('asset/strategy/angel-belakang-jenis-3.png') }}" alt="" class="img-fluid mb-3">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/angel-belakang-jenis-3.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/angel-belakang-jenis-3.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/angel-belakang-jenis-3.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>WING OF LOVE</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Desain WING OF LOVE adalah simbol dari jiwa-jiwa kuat yang memilih cinta di tengah dunia yang keras dan dingin. Sosok bersayap dalam balutan logam menggambarkan bahwa di balik kekuatan, masih ada kelembutan yang tak bisa dilukai.</p>
                                                <p class="mb-3">Visual hitam kromatik dan aksen ungu neon menghadirkan kesan elegan, futuristik, dan penuh energi tenang. Ini bukan cuma desain ini pernyataan bahwa kelembutan bukan kelemahan, melainkan bentuk tertinggi dari kekuatan.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="wing_of_love" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="wing_of_love">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img src="{{ asset('asset/strategy/nemesis-belakang-jenis-3.png') }}" alt="" class="img-fluid mb-3 mainImage">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/nemesis-belakang-jenis-3.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/nemesis-belakang-jenis-3.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/nemesis-belakang-jenis-3.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>NEMESIS</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Desain NEMESIS terinspirasi dari kekuatan sunyi yang muncul saat dunia dikuasai oleh ego dan ambisi. Sosok patung klasik bergaya Yunani memegang senjata modern sebuah kontras antara sejarah dan perlawanan masa kini.</p>
                                                <p class="mb-3">Ini bukan hanya seni. Ini simbol bahwa tak ada kekuasaan yang kebal terhadap penghakiman. Warna abu klasik dipadukan dengan oranye menyala menciptakan kesan ancient meets modern warfare—elegan, berbahaya, dan mengintimidasi.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="nemesis" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="nemesis">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                    </div><!-- /step 6-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>7/9</strong>Pilih Design Baju dari Category (Street Wear)</h3>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img id="mainImage" src="{{ asset('asset/strategy/make-money-belakang-jenis-4.png') }}" alt="" class="img-fluid mb-3">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/make-money-belakang-jenis-4.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/make-money-belakang-jenis-4.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/make-money-belakang-jenis-4.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>MAKE MONEY NOT GIRLFRIEND</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Buat lo yang lagi fokus bangun masa depan, desain ini jadi pernyataan hidup yang keras tapi jujur. Tulisan besar “MAKE MONEY NOT GIRLFRIEND” bukan cuma gaya, ini sikap. Fokus sama duit, bukan drama cinta.</p>
                                                <p class="mb-3">Gaya streetwear bold dan nyentrik ini dilengkapi ilustrasi bumi, mahkota, pesawat, dan elemen lain yang melambangkan ambisi, kekuatan, dan arah hidup lo yang nggak bisa ditahan siapa pun.</p>
                                                <p class="mb-3">Buat cowok yang lebih pilih bangun impian daripada hubungan yang nyusahin.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="make_money_not_girlfriend" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="make_money_not_girlfriend">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img src="{{ asset('asset/strategy/born-belakang-jenis-4.png') }}" alt="" class="img-fluid mb-3 mainImage">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/born-belakang-jenis-4.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/born-belakang-jenis-4.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/born-belakang-jenis-4.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>Born To Die</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Buat lo yang nggak takut jalanin hidup dengan segala tantangannya, desain ini jadi simbol sikap lo. Tulisan besar “BORN TO DIE” bukan cuma kata-kata ini pernyataan kalau hidup harus dijalani all out, tanpa takut dan tanpa ragu.</p>
                                                <p>Gaya streetwear bold dengan font graffiti tebal, ditambah splash biru yang bikin desain ini makin nyala dan penuh energi. Mahkota di atas huruf menandakan lo adalah raja di hidup lo sendiri—nggak ada yang bisa ngatur langkah lo.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="born_to_die" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="born_to_die">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                    </div><!-- /step 7-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>8/9</strong>Pilih Design Baju dari Category (Asian Art Fusion)</h3>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img id="mainImage" src="{{ asset('asset/strategy/bloomrage-belakang-jenis-5.png') }}" alt="" class="img-fluid mb-3">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/bloomrage-belakang-jenis-5.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/bloomrage-depan-jenis-5.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/bloomrage-belakang-jenis-5.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>Bloomrage</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda minima non odio animi laboriosam similique magni quo repudiandae, iusto dolorum natus rerum earum eligendi doloremque optio provident nemo pariatur culpa?</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="bloomrage" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="bloomrage">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img src="{{ asset('asset/strategy/samurai-belakang-jenis-5.png') }}" alt="" class="img-fluid mb-3 mainImage">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/samurai-belakang-jenis-5.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/samurai-belakang-jenis-5.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/strategy/samurai-belakang-jenis-5.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>Samurai</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda minima non odio animi laboriosam similique magni quo repudiandae, iusto dolorum natus rerum earum eligendi doloremque optio provident nemo pariatur culpa?</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="samurai" value="true">

                                                <div class="toggle-wrapper" id="likeToggle" data-name="samurai">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                    </div><!-- /step 7-->

                                    <div class="submit step">

                                        <h3 class="main_question"><strong>9/9</strong> Penutup</h3>

                                        <div class="row">
                                            <p>Terima kasih atas penilaian Anda. Masukan ini sangat berarti bagi kami untuk terus meningkatkan kreativitas dan inovasi.</p>
                                        </div><!-- /row -->

                                    </div><!-- /step 4-->

                                </div><!-- /middle-wizard -->
                                <div id="bottom-wizard">
                                    <button type="button" name="backward" class="backward">Backward </button>
                                    <button type="button" name="forward" class="forward">Forward</button>
                                    <button type="submit" class="submit">Submit</button>
                                </div><!-- /bottom-wizard -->
                            </form>
                        </div><!-- /Wizard container -->
                    </div><!-- /col -->
                </div><!-- /row -->
            </div><!-- /TAB 1:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
        </div><!-- /tab content -->
    </div><!-- /container-fluid -->
</div><!-- /wrapper_in -->
@endsection

@push('scripts')
<script>
   $(document).ready(function () {
    // Untuk thumbnail image per produk
    $('.thumb-image').on('click', function () {
        const newSrc = $(this).attr('src');
        // Cari parent yang paling dekat lalu update gambar utamanya
        $(this).closest('.col-md-5').find('.img-fluid').attr('src', newSrc);
    });

    // Untuk toggle like/dislike per produk
    $('.toggle-wrapper').on('click', function () {
        const toggle = $(this);
        const icon = toggle.find('img');
        const textToggle = toggle.find('small');
        const inputName = toggle.data('name');
        const hiddenInput = $(`input[name="${inputName}"]`);

        toggle.toggleClass('active');

        if (toggle.hasClass('active')) {
            icon.attr('src', `{{ asset('asset/category/icon-dislike.png') }}`); // 👎
            textToggle.text('Dislike');
            hiddenInput.val('false');
        } else {
            icon.attr('src', `{{ asset('asset/category/icon-like.png') }}`); // 👍
            textToggle.text('Like');
            hiddenInput.val('true');
        }
    });
});
</script>
@endpush

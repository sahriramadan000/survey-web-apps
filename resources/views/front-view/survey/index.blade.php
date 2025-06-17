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

                            <form name="example-1" id="wrapped" method="POST">
                                <input id="website" name="website" type="text" value=""><!-- Leave for security protection, read docs for details -->
                                <div id="middle-wizard">
                                    <div class="step">
                                        <h3 class="main_question"><strong>1/4</strong>Data Diri</h3>

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Tuliskan nama kamu">
                                        </div>
                                       <div class="form-group">
                                            <select name="year" class="form-control">
                                                <option value="">Pilih tahun lahir anda</option>
                                                <?php
                                                    for ($year = 1970; $year <= 2025; $year++) {
                                                        echo "<option value=\"$year\">$year</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div><!-- /step 1-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>2/4</strong>Jenis Baju</h3>

                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-1.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-2.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-3.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
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
                                                        <input name="question_2" type="radio" value="L" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size L
                                                        <input name="question_2" type="radio" value="L" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size XL
                                                        <input name="question_2" type="radio" value="L" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-group radio_questions">
                                                    <label class="p-3">
                                                        Size XXL
                                                        <input name="question_2" type="radio" value="L" class="icheck2 required">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /step 1-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>3/4</strong>Pilih Kategori Desain</h3>

                                         <div class="row justify-content-center">
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-design-1.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-design-1.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-design-1.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-design-1.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group radio_questions">
                                                    <label>
                                                        <img src="{{ asset('asset/jenis-design-1.png') }}" alt="" class="img-fluid">
                                                        <input name="question_1" type="radio" value="Boxie" class="icheck required">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /step 2-->

                                    <div class="step">
                                        <h3 class="main_question"><strong>4/4</strong>Pilih Design Baju dari Category (Street Grit Aesthetic)</h3>

                                        <div class="row mb-3">
                                            <div class="col-12 col-md-5">
                                                <!-- Main Image -->
                                                <img id="mainImage" src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-2-belakang-fix.png') }}" alt="" class="img-fluid mb-3">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-2-belakang-fix.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-2-depan-fix.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-2-depan-fix.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>Resurge</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda minima non odio animi laboriosam similique magni quo repudiandae, iusto dolorum natus rerum earum eligendi doloremque optio provident nemo pariatur culpa?</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="article_name" value="Resurge">
                                                <input type="hidden" name="like_status" id="likeStatus">

                                                <div class="toggle-wrapper" id="likeToggle">
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
                                                <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-1-belakang-fix.png') }}" alt="" class="img-fluid mb-3 mainImage">

                                                <!-- Thumbnails -->
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-1-belakang-fix.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-1-depan-fix.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('asset/category/Street-grit-aesthetic/Main-Image-1-depan-fix.png') }}" alt="Thumb 1" class="img-thumbnail thumb-image" style="cursor: pointer;">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Informasi Produk -->
                                            <div class="col-12 col-md-7">
                                                <h2 class="text-uppercase">Nama Artikel: <strong>No Mercy</strong></h2>
                                                <p class="mb-1">Deskripsi:</p>
                                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda minima non odio animi laboriosam similique magni quo repudiandae, iusto dolorum natus rerum earum eligendi doloremque optio provident nemo pariatur culpa?</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sit accusamus asperiores iusto laboriosam qui et. Distinctio molestiae incidunt optio, fugiat libero, quas cupiditate voluptatem, sapiente natus tempore odio laborum.</p>

                                                <!-- Hidden input untuk menyimpan nama artikel dan gambar -->
                                                <input type="hidden" name="article_name" value="No Mercy">
                                                <input type="hidden" name="like_status" id="likeStatus">

                                                <div class="toggle-wrapper" id="likeToggle">
                                                    <div class="toggle-indicator d-flex flex-column">
                                                        <img id="toggleIcon" src="https://cdn-icons-png.flaticon.com/512/889/889140.png" alt="Like">
                                                        <small id="textToggle">Like</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /row-->
                                    </div><!-- /step 3-->

                                    <div class="submit step">

                                        <h3 class="main_question"><strong>4/4</strong>Please fill with your details</h3>

                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="company_name" class="form-control" placeholder="Your company name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="firstname" class="required form-control" placeholder="First name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="lastname" class="required form-control" placeholder="Last name">
                                                </div>
                                            </div><!-- /col-sm-6 -->

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="required form-control" placeholder="Your Email">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="telephone" class="required form-control" placeholder="Your Telephone">
                                                </div>
                                                <div class="form-group">
                                                    <div class="styled-select">
                                                        <select class="required" name="country">
                                                            <option value="" selected>Select your country</option>
                                                            <option value="Europe">Europe</option>
                                                            <option value="Asia">Asia</option>
                                                            <option value="North America">North America</option>
                                                            <option value="South America">South America</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div><!-- /col-sm-6 -->
                                        </div><!-- /row -->

                                        <div class="form-group checkbox_questions">
                                            <input name="terms" type="checkbox" class="icheck required" value="yes">
                                            <label>Please accept <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">terms and conditions</a> ?
                                            </label>
                                        </div>

                                    </div><!-- /step 4-->

                                </div><!-- /middle-wizard -->
                                <div id="bottom-wizard">
                                    <button type="button" name="backward" class="backward">Backward </button>
                                    <button type="button" name="forward" class="forward">Forward</button>
                                    <button type="submit" name="process" class="submit">Submit</button>
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

        toggle.toggleClass('active');

        if (toggle.hasClass('active')) {
            icon.attr('src', `{{ asset('asset/category/icon-dislike.png') }}`); // 👎
            textToggle.text('Dislike');
        } else {
            icon.attr('src', `{{ asset('asset/category/icon-like.png') }}`); // 👍
            textToggle.text('Like');
        }

        // Optional: Simpan status ke input hidden
        toggle.closest('.col-md-7').find('input[name="like_status"]').val(toggle.hasClass('active') ? 'Dislike' : 'Like');
    });
});
</script>
@endpush

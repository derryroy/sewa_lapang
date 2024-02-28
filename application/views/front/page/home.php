<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url(assets/front/img/slide1.jpeg)"></div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url(assets/front/img/slide2.jpeg)"></div>


        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

    </div>
</section><!-- End Hero -->

<main id="main">



    <!-- ======= Booking Section ======= -->
    <section id="booking" class="about">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="mb-3" id="calendar"></div>
                    <p style="font-size:12px;">
                            <table style="font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 20px;background-color: #e6101096;"></td>
                                        <td>Warna Merah</td>
                                        <td> : </td>
                                        <td> Tanggal Hari ini
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20px;background-color: #ffe770;"></td>
                                        <td>Warna Kuning</td>
                                        <td> : </td>
                                        <td> Tanggal Yang di Pilih
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20px;background-color: #ced4da;"></td>
                                        <td>Warna Abu</td>
                                        <td> : </td>
                                        <td> Tanggal Data Yang di Pesan
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </p>
                </div>

                <div class="col-xl-5 col-lg-6 result" id="result">
                    <table class="table text-center" style="vertical-align:middle;font-size:13px;">
                        <thead class="text-start">
                            <th colspan="4">
                                <h6 class="resDate">data</h6>
                            </th>
                        </thead>
                        <tbody class="jadwal"></tbody>
                    </table>

                    <div class="checkout"></div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Booking Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container-fluid">

            <div class="section-title">
                <h3>Hubungi <span>Kami</span></h3>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="map mb-5">
                                <iframe style="border:0; width: 100%; height: 420px;" src="https://maps.google.com/maps?width=1024&amp;height=350&amp;hl=en&amp;q=gor c-tra&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row justify-content-center">
                                <div class="col-md-12 info d-flex flex-column align-items-stretch">
                                    <a href="https://wa.me/6212345678" target="_blank">
                                        <i class="bx bx-phone"></i>
                                        <h4>Whatsapp</h4>
                                        <p>12345678</p>
                                    </a>
                                </div>
                                <div class="col-md-12 info d-flex flex-column align-items-stretch">
                                    <a href="mailto:cs@c-traarena.id">
                                        <i class="bx bx-envelope"></i>
                                        <h4>Email Kami</h4>
                                        <p>cs@c-traarena.id</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<script src="<?php echo base_url() . 'assets/front/js/page/home.js?version=' . time(); ?>"></script>
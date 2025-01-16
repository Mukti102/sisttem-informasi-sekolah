<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <title>SMKS St. Nahanson Parapat | SiAna</title>
</head>
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

:root {
    --primary1-color: #577BC1; /* Merah tua */
    --primary-color: #000957;
    --secondary-color: #007bff; /* Warna yang lebih cerah */
    --secondary-color-light: #344CB7; /* Tetap sama */
    --text-light: #ffffff; /* Tetap sama */
    --white: #ffffff; /* Tetap sama */
    --black: #000000; /* Tetap sama */
    --max-width: 1200px; /* Tetap sama */
    --gray: #ced4da;




}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.section__container {
    max-width: var(--max-width);
    margin: auto;
    padding: 5rem 1rem;
}

.section__header {
    font-size: 2.5rem;
    font-weight: 600;
}

.section__subheader {
    position: relative;
    isolation: isolate;
    margin-bottom: 1rem;
    padding-left: 20px;
    font-size: 1.2rem;
    font-weight: 500;
}

.section__subheader::after {
    position: absolute;
    content: "";
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    height: 45px;
    aspect-ratio: 1;
    background-color: var(--primary1-color);
    z-index: -1;
}

.btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.75rem 1.5rem;
    outline: none;
    font-size: 1rem;
    color: var(--white);
    border-radius: 5px;
    cursor: pointer;
}

.btn__secondary {
    background-color: transparent;
    border: 1px solid var(--white);
}

.btn__primary {
    background-color: var(--primary1-color);
    border: 1px solid var(--primary1-color);
}

.btn span {
    font-size: 1.2rem;
    transition: 0.3s;
}

.btn:hover span {
    transform: translateX(5px);
}

img {
    display: flex;
    width: 100%;
}

a {
    text-decoration: none;
}

html,
body {
    scroll-behavior: smooth;
}

body {
    font-family: "Poppins", sans-serif;
    color: var(--white);
}

header {
    background-image: linear-gradient(to right,
            rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.8)),
            url("{{ asset('assets/img/landing/landing1.png') }}");


    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    background-blend-mode: multiply;
}

nav {
    max-width: var(--max-width);
    margin: auto;
    padding: 2rem 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.nav__logo a {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray);
}

.nav__links {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 2rem;
}

.link a {
    padding: 5px;
    font-size: 1rem;
    font-weight: 500;
    color: var(--white);
    transition: 0.3s;
}

.link a:hover {
    color: var(--primary-color);
}

.nav__menu__btn {
    display: none;
    font-size: 1.5rem;
}

.header__container {
    padding-block: 5rem 12rem;
}

.header__container h1 {
    max-width: 900px;
    margin-inline: auto;
    margin-bottom: 2rem;
    font-size: 4rem;
    font-weight: 700;
    text-align: center;
}

.header__container .btn {
    margin: auto;
}

.about {
    background-color: var(--gray);
}

.about__container {
    padding-block: 0;
}

.about__grid {
    padding: 2rem;
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 4rem;
    align-items: center;
    background-color: var(--primary-color);
    transform: translateY(-5rem);
    border-radius: 10px;
}

.about__content .section__header {
    margin-bottom: 1rem;
}

.about__content .para {
    color: var(--text-light);
}

.about__list {
    display: grid;
    gap: 2rem;
}

.about__item {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.about__item span {
    padding: 13px 20px;
    font-size: 1.75rem;
    color: var(--secondary-color);
    background-color: var(--gray);
    border-radius: 5px;
}

.about__item h4 {
    font-size: 1.2rem;
    font-weight: 600;
}

.stats {
    background-color: var(--primary-color);
}

.stats__container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.stats__content .section__header {
    margin-bottom: 1rem;
}

.stats__content .para {
    margin-bottom: 2rem;
    color: var(--text-light);
}

.stats__grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.stats__card span {
    font-size: 1.75rem;
    color: var(--primary-color);
}

.stats__card h4 {
    font-size: 2rem;
    font-weight: 700;
}

.stats__card p {
    font-weight: 500;
}

.stats__image {
    display: grid;
    gap: 2rem;
}

.stats__image img {
    max-width: 450px;
    margin: auto;
    border-radius: 5px;
}

.banner {
    background-image: linear-gradient(to right,
            rgba(0, 0, 0, 0.6),
            rgba(0, 0, 0, 0.2)),
            url("{{ asset('assets/img/landing/landing2.png') }}");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    height: 350px; /* Tambahkan ukuran tinggi banner */
}

.banner__content {
    max-width: 800px;
}

.banner__content .section__header {
    margin-bottom: 1rem;
}

.banner__content .para {
    max-width: 600px;
    margin-bottom: 2rem;
}

.banner__btns {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.blog {
    background-color: var(--primary-color);
}

.blog__grid {
    margin-top: 4rem;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.blog__card img {
    margin-bottom: 1rem;
    border-radius: 5px;
}

.blog__card>div {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.blog__card div span {
    font-size: 0.9rem;
    color: var(--text-light);
}

.blog__card div span i {
    margin-right: 5px;
    font-size: 1rem;
    color: var(--primary-color);
}

.blog__card h4 {
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
    font-weight: 600;
}

.blog__card p {
    color: var(--text-light);
}

.subscribe {
    background-image: linear-gradient(to right,
            rgba(0, 0, 0, 0.6),
            rgba(0, 0, 0, 0.6)),
            url("{{ asset('assets/img/landing/landing3.png') }}");
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 350px;
}

.subscribe__container {
    max-width: 700px;
    text-align: center;
}

.subscribe__container .section__subheader {
    max-width: fit-content;
    margin-inline: auto;
}

.subscribe__container form {
    margin-block: 2rem 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.subscribe__container input {
    flex: 1;
    width: 100%;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    outline: none;
    border: 1px solid var(--white);
    border-radius: 5px;
}

.subscribe__container .btn {
    flex: 1;
    justify-content: center;
}

.subscribe__container .para a {
    color: var(--primary-color);
}

.customer {
    background-color: var(--secondary-color-light);
}

.customer__container .para {
    margin-block: 1rem 4rem;
    color: var(--text-light);
}

.swiper {
    width: 100%;
    padding-bottom: 4rem;
}

.customer__review .swiper-pagination-bullet-active {
    background-color: var(--primary-color);
}

.customer__review__card {
    position: relative;
    isolation: isolate;
    max-width: 600px;
    margin-inline: auto;
    text-align: center;
}

.customer__review__card span {
    position: absolute;
    top: 0;
    left: 0;
    font-size: 6rem;
    line-height: 4rem;
    color: var(--primary-color);
    opacity: 0.1;
}

.customer__review__card p {
    margin-bottom: 2rem;
    color: var(--text-light);
}

.customer__review__details {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.customer__review__details img {
    max-width: 40px;
    border-radius: 50;
}

.customer__review__details h4 {
    font-size: 1.2rem;
    font-weight: 500;
}

.customer__review__details h5 {
    font-size: 0.9rem;
    font-weight: 400;
    color: var(--text-light);
}

.footer {
    background-color: var(--black);
}

.footer__container {
    display: grid;
    grid-template-columns: 1.5fr repeat(3, 1fr);
    gap: 2rem;
}

.footer__col h5 a {
    display: inline-block;
    margin-bottom: 1rem;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--white);
}

.footer__col p {
    margin-bottom: 2rem;
    color: var(--text-light);
}

.footer__socials {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.footer__socials a {
    padding: 5px 10px;
    font-size: 1.25rem;
    color: var(--primary-color);
    background-color: var(--secondary-color-light);
    border-radius: 100%;
    cursor: pointer;
    transition: 0.3s;
}

.footer__socials a:hover {
    color: var(--white);
    background-color: var(--primary-color);
}

.footer__col h4 {
    margin-bottom: 1rem;
    font-size: 1.2rem;
    font-weight: 600;
}

.footer__links a {
    margin-bottom: 1rem;
    display: flex;
    color: var(--text-light);
    transition: 0.3s;
}

.footer__links a:hover {
    color: var(--primary-color);
}

.footer__bar {
    padding: 1rem;
    font-size: 0.8rem;
    text-align: center;
    color: var(--text-light);
}

@media (width < 900px) {
    .nav__links {
        gap: 1.5rem;
    }

    .about__grid {
        grid-template-columns: repeat(1, 1fr);
    }

    .stats__container {
        grid-template-columns: repeat(1, 1fr);
    }

    .stats__image {
        grid-area: 1/1/2/2;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .blog__grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem 1rem;
    }

    .footer__container {
        grid-template-columns: 2fr 1fr;
    }
}

@media (width < 600px) {
    nav {
        position: fixed;
        width: 100%;
        padding: 1rem;
        background-color: var(--black);
        z-index: 99;
    }

    .nav__links {
        position: absolute;
        left: 0;
        top: 68px;
        padding: 2rem;
        width: 100%;
        flex-direction: column;
        transform: scaleY(0);
        transform-origin: top;
        transition: 0.5s;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .nav__links .link a {
        opacity: 0;
    }

    .nav__links.open .link a {
        opacity: 1;
    }

    .nav__links.open {
        transform: scaleY(1);
    }

    .nav__menu__btn {
        display: block;
    }

    .header__container h1 {
        margin-top: 4rem;
        font-size: 3.5rem;
    }

    .stats__image {
        grid-template-columns: repeat(1, 1fr);
    }

    .blog__grid {
        grid-template-columns: repeat(1, 1fr);
    }

    .subscribe__container form {
        flex-direction: column;
    }

    .subscribe__container .btn {
        width: 100%;
    }
}
</style>

<body>
    <header>
        <nav>
            <div class="nav__logo"><a href="#">SiAna</a></div>
            <ul class="nav__links" id="nav-links">
                <li class="link"><a href="#home">Beranda</a></li>
                <li class="link"><a href="#about">Tentang</a></li>
                <li class="link"><a href="#stats">Kejuruan</a></li>
                <li class="link"><a href="#blog">Galeri</a></li>
                <li class="link"><a href="#subscribe">Testimoni</a></li>
                <li class="link"><a href="/login">Login</a></li>

            </ul>

            <div class="nav__menu__btn" id="menu-btn">
                <span><i class="ri-menu-line"></i></span>
            </div>
        </nav>
        <div class="section__container header__container" id="home">
            <h1>Selamat Datang, di SMKS St. Nahanson Parapat</h1>
        </div>
    </header>

    <section class="about" id="about">
        <div class="section__container about__container">
            <div class="about__grid">
                <div class="about__content">
                    <p class="section__subheader">Tentang</p>
                    <h2 class="section__header">Sejarah Yayasan Nahanson</h2>

                    SMKS ST. NAHANSON PARAPAT menjadi pilihan tepat bagi para siswa yang ingin melanjutkan pendidikan di
                    bidang kejuruan dengan kualitas terbaik di Kabupaten Tapanuli Utara.
                    Fasilitas lengkap, tenaga pengajar yang kompeten, dan akreditasi A menjadikan sekolah ini sebagai
                    tempat yang ideal untuk mengembangkan potensi dan meraih prestasi.

                    </p>
                    <br />
                        Sipoholon, Kecamatan Sipoholon, Kabupaten Tapanuli Utara, Sumatera Utara
                    </p>
                </div>
                <div class="about__list">
                    <div class="about__item">
                        <span><i class="ri-global-fill"></i></span>
                        <h4>Mewujudkan pendidikan bermartabat</h4>
                    </div>
                    <div class="about__item">
                        <span><i class="ri-bar-chart-fill"></i></span>
                        <h4>Menghasilkan siswa yang memili kompetensi</h4>
                    </div>
                    <div class="about__item">
                        <span><i class="ri-thumb-up-fill"></i></span>
                        <h4>Mewujudkan lulusan yang siap bekerja</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats" id="stats">
        <div class="section__container stats__container">
            <div class="stats__grid">
                <div class="stats__card">
                    <div class="stats__content">
                        <p class="section__subheader">Program Jurusan</p>
                        <h2 class="section__header">Teknik Kendaraan Ringan</h2>


                        <p class="para">
                            Jurusan ini menawarkan pembelajaran praktis dan teori di bidang
                            otomotif, khususnya kendaraan ringan. Siswa dibekali keterampilan
                            yang sesuai dengan kebutuhan industri, menjadikan mereka siap
                            bersaing di dunia kerja setelah lulus.

                        </p>
                    </div>
                    <div class="stats__image">
                        <img src="{{ asset('assets/img/landing/tkr1.jpg') }}" alt="stats" />
                    </div>

                </div>
                <div class="stats__card">
                    <div class="stats__image">
                        <img src="{{ asset('assets/img/landing/tkj1.jpg') }}" alt="stats" />
                    </div>
                    <div class="stats__content">
                        <p class="section__subheader">Program Jurusan</p>
                        <h2 class="section__header">Teknik Jaringan Komputer & Telekomunikasi</h2>
                        <p class="para">
                            Menguasai jaringan komputer dan telekomunikasi, Anda dapat
                            mengembangkan sistem jaringan yang aman dan efisien untuk
                            perusahaan dan organisasi. Dapatkan kemampuan teknis dan
                            manajerial yang dibutuhkan untuk menjadi ahli jaringan yang
                            handal.

                        </p>
                    </div>
                </div>
            </div>
            <div class="stats__image">
                <img src="{{ asset('assets/img/landing/tkj2.jpg') }}" alt="stats" />
                <img src="{{ asset('assets/img/landing/tkr2.jpg') }}" alt="stats" />
            </div>
    </section>

    <section class="banner">
        <div class="section__container banner__container">
            <div class="banner__content">
                <p class="section__subheader">Tentang Kami</p>
                <h2 class="section__header">

                <h2 style="font-size: 2.5rem;">Daftar Sekarang dan Dapatkan Penawaran Terbaik</h2>
            </h2> 
        </h2>
                <p class="para">
                    Kami memiliki jaringan dengan perusahaan-perusahaan ternama seperti
                    Telkom, BMKG, BKN, Suzuki, Toyota dan masih banyak lagi. Oleh
                    karena itu, siswa-siswa kami memiliki kesempatan yang sangat besar
                    untuk melakukan prakerin dan magang di perusahaan-perusahaan
                    tersebut.
                </p>
            </div>
        </div>
    </section>

    <section class="blog" id="blog">
        <div class="section__container blog__container">
            <p class="section__subheader">Memori Nahanson</p>
            <h2 class="section__header">Momentum Kita</h2>
            <div class="blog__grid">
                <div class="blog__card">
                    <img src="assets/img/landing/padus.jpg" alt="blog" />
                    <div>
                        <span><i class="ri-user-line"></i> By Padus</span>
                        <span><i class="ri-time-line"></i> Des 11, 2024</span>

                    </div>
                    <h4>Pesta Paduan Suara Gerejawi</h4>
                    <p>
                        Perayaan penuh kegembiraan dan syukur dalam
                        acara pesta paduan suara gerejawi.
                    </p>
                </div>
                <div class="blog__card">
                    <img src="assets/img/landing/musikal.jpg" alt="blog" />
                    <div>
                        <span><i class="ri-user-line"></i> By TimSeni</span>
                        <span><i class="ri-time-line"></i> Oct 11, 2024</span>

                    </div>
                    <h4>Musikalisasi Seni</h4>
                    <p>
                        Musikalisasi seni dalam kartya Sitor Situmorang yang berjudul "Tatahan Pesan Bunda"
                    </p>
                </div>
                <div class="blog__card">
                    <img src="assets/img/landing/sumpah.jpg" alt="blog" />
                    <div>
                        <span><i class="ri-user-line"></i> By OSIS</span>
                        <span><i class="ri-time-line"></i> OCT 29, 2024</span>

                    </div>
                    <h4>Perayaan Sumpah Pemuda</h4>
                    <p>
                        Menggunakan baju adat tradisional untuk merayakan perayaan Sumpah Pemuda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="subscribe" id="subscribe">
        <div class="section__container subscribe__container">
            <p class="section__subheader">Info Lebih</p>
            <h2 class="section__header">
                Hubungi kita atau datang langsung ke sekolah
            </h2>
            <p class="para" style="font-size: 1.25rem;">
                Hubungi kami untuk informasi lebih lanjut atau kunjungi alamat kami di
                Jl. Balige Km.7 Sipoholon, Kecamatan Sipoholon, Kabupaten Tapanuli Utara. 
                Kontak: (123) 456-7890
            </p>
        </div>
    </section>

    <section class="customer">
        <div class="section__container customer__container">
            <p class="section__subheader">Kata Alumni</p>
            <h2 class="section__header">Apa Kata Alumni</h2>
            <p class="para">
                Temukan kesan dan cerita yang dibagikan oleh para alumni tentang pengalaman istimewa mereka 
                selama menempuh pendidikan di SMKS St. Nahanson Parapat. Mereka berbagi bagaimana sekolah ini
                 telah memberi fondasi yang kuat dan inspirasi bagi perjalanan karir mereka.
            </p>
            <div class="customer__review">
                <!-- Slider main container -->
                <div class="swiper swiper-autoplay">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="customer__review__card">
                                <span><i class="ri-double-quotes-r"></i></span>
                                <p>
                                    Halo semua, saya merasa sangat beruntung bisa belajar di SMKS St. Nahanson Parapat.
                                    Sekolah ini memiliki fasilitas yang sangat memadai dan tenaga pengajar yang sangat profesional.
                                    Saya sangat senang bisa belajar di sini dan mendapatkan pengalaman baru yang menarik.
                                    Saya juga menjadi memiliki pengalaman magang di perusahaan ternama.
                                </p>
                                <div class="customer__review__details">
                                    <img src="{{ asset('assets/img/landing/tungkot.jpg') }}" alt="stats" />
                                    <div>
                                        <h4>Tungkot Simorangkir</h4>
                                        <h5>Universitas Telkom Surabaya</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="customer__review__card">
                                <span><i class="ri-double-quotes-r"></i></span>
                                <p>
                                    In the construction industry, deadlines and quality are
                                    non-negotiable. Induz consistently delivered on both fronts.
                                    Their dedication to project management and their skilled
                                    workforce made our project a seamless success. We're
                                    grateful for their expertise.
                                </p>
                                <div class="customer__review__details">
                                    <img src="assets/customer-2.jpg" alt="customer" />
                                    <div>
                                        <h4>Laura Rodriguez</h4>
                                        <h5>CEO & Founder</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="customer__review__card">
                                <span><i class="ri-double-quotes-r"></i></span>
                                <p>
                                    The logistics solutions provided by Induz have streamlined
                                    our supply chain like never before. Their innovative
                                    approach and attention to detail saved us time and
                                    resources, ultimately boosting our bottom line. They're more
                                    than a vendor; they're a partner in our success.
                                </p>
                                <div class="customer__review__details">
                                    <img src="assets/customer-3.jpg" alt="customer" />
                                    <div>
                                        <h4>Mark Thompson</h4>
                                        <h5>Architect</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <h5><a href="#">Induz.</a></h5>
                <p>
                    We strive to be at the forefront of technological advancements and
                    industry best practices, consistently exceeding the expectations of
                    our clients.
                </p>
                <div class="footer__socials">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-twitter-fill"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-linkedin-fill"></i></a>
                </div>
            </div>
            <div class="footer__col">
                <h4>Quick Links</h4>
                <div class="footer__links">
                    <a href="#">Home</a>
                    <a href="#">About Us</a>
                    <a href="#">Services</a>
                    <a href="#">Blog</a>
                    <a href="#">Career</a>
                </div>
            </div>
            <div class="footer__col">
                <h4>Our Services</h4>
                <div class="footer__links">
                    <a href="#">Chemical Research</a>
                    <a href="#">Construction Material</a>
                    <a href="#">Agricultural Engineering</a>
                    <a href="#">Bridge Engineering</a>
                    <a href="#">Automative & Systems</a>
                </div>
            </div>
            <div class="footer__col">
                <h4>Help</h4>
                <div class="footer__links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Support</a>
                    <a href="#">Terms & Condition</a>
                </div>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2023 Web Design Mastery. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- File JS Lokal -->
<script src="{{ asset('assets/js/main.js') }}"></script>


<!-- Script Swiper Initialization -->
<script>
    const swiper = new Swiper('.swiper-autoplay', {
        loop: true, // Membuat slider loop
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 3000, // Waktu antar slide (3 detik)
            disableOnInteraction: false, // Tetap berjalan meskipun ada interaksi
        },
    });
</>

</body>

</html>
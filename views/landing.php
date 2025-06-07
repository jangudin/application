<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Regfaskes</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/landing/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="#page-top">REGFASKES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item">

                        <a class="nav-link me-lg-3" href="<?php echo site_url('admin/halaman_juknis') ?>">Download Juknis</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link me-lg-3" href="#download">Daftar</a> -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Daftar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo site_url('register/index')
                                                                ?>">User Fasyankes</a></li>
                            <li><a class="dropdown-item" href="https://dfo.kemkes.go.id/registrasi">User Fasyankes Puskesmas</a></li>
                            <li><a class="dropdown-item" href="<?php echo site_url('register/index_dinkes_kota')
                                                                ?>">User Dinkes Provinsi / Kabkota</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal"> -->
                <?php
                //$uri = "https://registrasifasyankes.kemkes.go.id/landing";
                $uri = "http://192.168.67.145/registrasifaskes/Landing";
                $encodedUri = urlencode($uri);
                $url = "http://192.168.50.86/single-sign-on?continued=";
                //$url = "https://akun-yankes.kemkes.go.id/?continued=";
                // $url = "http://202.70.136.86/single/?continued=";
                $url = $url . $encodedUri;
                // echo $url;
                ?>
                <a class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" href="<?= $url ?>">
                    <span class="d-flex align-items-center">
                        <!-- <i class="bi-chat-text-fill me-2"></i> -->
                        <!-- <i class="bi bi-file-earmark-lock2"></i> -->
                        <span class="small">Login</span>
                    </span>
                </a>
            </div>
        </div>
    </nav>
    <?php
    if ($this->session->flashdata('message_name') != null) {

    ?>
        <div class="container-fluid">
            <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4>
                <?= $this->session->flashdata('message_name'); ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Mashead header-->
    <header class="masthead" style="background-color:white; min-height: 44rem">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Registrasi Fasyankes</h1>
                        <p class="lead fw-normal text-muted mb-5">Aplikasi pencatatan resmi Fasilitas Pelayanan Kesehatan di Kementerian Kesehatan untuk mendapatkan kode fasyankes</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <!-- <a class="me-lg-3 mb-4 mb-lg-0" href="#!"><img class="app-badge" src="assets/landing/assets/img/google-play-badge.svg" alt="..." /></a>
                                <a href="#!"><img class="app-badge" src="assets/landing/assets/img/app-store-badge.svg" alt="..." /></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Masthead device mockup feature-->

                    <!-- <div class="masthead-device-mockup">
                        <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect>
                        </svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                        <div class="device-wrapper">
                            <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                <div class="screen bg-black"> -->

                    <!-- PUT CONTENTS HERE:
                                    * * This can be a video, image, or just about anything else.
                                    * * Set the max width of your media to 100% and the height to
                                    * * 100% like the demo example below. -->

                    <!-- <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%">
                                        <source src="assets/landing/assets/img/demo-screen.mp4" type="video/mp4" />
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <img style="max-width: 100%;" src="<?php echo base_url() . 'assets/landing/assets/img/landingpage.jpg' ?>" />

                    <!-- Masthead -->
                </div>
            </div>
        </div>
    </header>
    <!-- Footer-->
    <footer class="bg-black text-center py-1">
        <div class="container px-5">
            <div class="text-white-50 small">
                <div class="mb-2">&copy; 2024 Direktorat Jenderal Pelayanan Kesehatan - Kementerian Kesehatan Republik Indonesia.</div>
                <!-- <a href="#!">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">FAQ</a> -->
            </div>
        </div>
    </footer>
    <!-- Feedback Modal-->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary p-4">
                    <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Send feedback</h5>
                    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 p-4">
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Full name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Phone number input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                        <!-- Submit success message-->
                        <!---->
                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->
                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">Error sending message!</div>
                        </div>
                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/landing/js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>

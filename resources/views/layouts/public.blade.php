<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('storage/img/favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/font-awesome.all.css') }}" type="text/css" rel="stylesheet">
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <link href="{{ asset('css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style type="text/css">

        body {
            background-color: #FFFFFF;
        }

        .btn_default {
            background-color: #1b4b72;
            color: white;
        }

        .form-control {
            height: calc(1.75em + .75rem + 2px);
            padding: .5rem .75rem;
        }

        .select2-container .select2-selection--single {
            height: 40px;
            padding: 0.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 3px;
        }

        #header {
            height:120px;
            background: linear-gradient(120deg, #1b4b72 55%, #fd7e14 45%);
        }


        @media  only screen and (min-device-width: 200px) {
            .header_title_1 {
                font-size: 87%;
            }
            .header_title_2 {
                font-size: 63%;
            }

            .header_title_3 {
                font-size: 35%;
            }
        }

        @media  only screen and (min-device-width: 300px) {
            .header_title_1 {
                font-size: 87%;
            }
            .header_title_2 {
                font-size: 63%;
            }

            .header_title_3 {
                font-size: 35%;
            }
        }

        @media  only screen and (min-device-width: 324px) {
            .header_title_1 {
                font-size: 87%;
            }
            .header_title_2 {
                font-size: 63%;
            }

            .header_title_3 {
                font-size: 40%;
            }
        }


        @media  only screen and (min-device-width: 350px) {
            .header_title_1 {
                font-size: 87%;
            }
            .header_title_2 {
                font-size: 63%;
            }

            .header_title_3 {
                font-size: 45%;
            }
        }

        @media  only screen and (min-device-width: 392px) {
            .header_title_1 {
                font-size: 87%;
            }
            .header_title_2 {
                font-size: 63%;
            }

            .header_title_3 {
                font-size: 50%;
            }
        }

        @media  only screen and (min-device-width: 420px) {
            .header_title_1 {
                font-size: 90%;
            }
            .header_title_2 {
                font-size: 65%;
            }

            .header_title_3 {
                font-size: 55%;
            }
        }

        @media  only screen and (min-device-width: 450px) {
            .header_title_1 {
                font-size: 100%;
            }
            .header_title_2 {
                font-size: 70%;
            }

            .header_title_3 {
                font-size: 60%;
            }
        }

        @media  only screen and (min-device-width: 576px) {
            .header_title_1 {
                font-size: 105%;
            }
            .header_title_2 {
                font-size: 73%;
            }

            .header_title_3 {
                font-size: 63%;
            }
        }


        @media  only screen and (min-device-width: 768px) {
            .header_title_1 {
                font-size: 110%;
            }
            .header_title_2 {
                font-size: 75%;
            }

            .header_title_3 {
                font-size: 65%;
            }
        }

        @media  only screen and (min-device-width: 992px) {
            .header_title_1 {
                font-size: 110%;
            }
            .header_title_2 {
                font-size: 75%;
            }

            .header_title_3 {
                font-size: 65%;
            }
        }


        @media  only screen and (min-device-width: 1200px) {
            .header_title_1 {
                font-size: 120%;
            }
            .header_title_2 {
                font-size: 80%;
            }

            .header_title_3 {
                font-size: 70%;
            }
        }



        .modal_seventy {
            max-width: 70%;
        }

        .modal_eighty {
            max-width: 80%;
        }

        .modal_ninety {
            max-width: 90%;
        }






    </style>
</head>
<body>
    <div class="container-fluid" id="header">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-11 col-lg-10 col-xl-9 mx-auto text-center">
                <div class="row">
                    <div class="col-6 text-right pt-2">
                        <div class="row">
                            <div class="col text-white header_title_1">2<sup>nd</sup> BES-MAYO ADVANCED</div>
                        </div>
                        <div class="row">
                            <div class="col text-white header_title_1">COURSE IN ENDOCRINOLOGY</div>
                        </div>
                        <div class="row">
                            <div class="col text-white header_title_2">21-23 February, 2012</div>
                        </div>
                        <div class="row">
                            <div class="col text-white header_title_2">Dhaka, Bangladesh</div>
                        </div>
                    </div>
                    <div class="col-3 pt-4">
                        <div class="row">
                            <div class="col text-right text-white header_title_3">Organized By</div>
                        </div>
                        <div class="row">
                            <div class="col text-right" style="padding-right: 27px;">
                                <img src="{{ asset('storage/img/logo.png') }}" width="50" height="50">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 pt-4">
                        <div class="row">
                            <div class="col text-right text-white header_title_3">In Association With</div>
                        </div>
                        <div class="row">
                            <div class="col text-right" style="padding-right: 35px;">
                                <img src="{{ asset('storage/img/mayo_clinic.png') }}" width="50" height="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @yield('content')
    </div>
    <div class="container-fluid fixed-bottom">
        <div class="row">
            <div class="col text-center" style="font-size: 0.8rem; padding-top: 15px; padding-bottom: 15px; color: white; background-color: #222d3f;">
                Copyright &copy; {{ date('Y') }} Bangladesh Endocrine Society. All Rights Reserved.
            </div>
        </div>
    </div>
</body>
</html>

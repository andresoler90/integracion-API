<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @stack('sectionStyles_layouts')

    <style>

        .btn-payment
        {
            font-weight: bold;
            margin: 0px auto !important;
            display: table !important;
            background-color: rgb(0,169,131,0.8) !important;
        }

        .payment-text-primary
        {
            text-align: center;
            font-weight: bold;
            color: rgba(0, 169, 131,1);
            text-transform: uppercase;
        }

        .center
        {
            margin-top: 12.5vh;
            margin-left: 12.5vh;
        }

        #content-wrapper
        {
            background-color: transparent !important;
            height: 100vh;
        }

        .bg-green
        {
            background-color: rgb(0,169,131,0.8);
            color: #fff;
        }

        .logo
        {
            margin: 15px;
        }

        footer.sticky-footer
        {
            z-index: 100;
        }

        .foreground
        {
            width: 100%;
        }

        .background
        {
            filter: sepia(70%);
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('img/payment.jpg')}}');
            background-size: cover;
        }

        .box-shadow
        {
            box-shadow: rgba(8, 187, 149, 0.4) -5px 5px, rgba(11, 149, 118, 0.3) -10px 10px, rgba(2, 53, 42, 0.2) -15px 15px, rgba(0, 169, 131, 0.1) -20px 20px, rgba(240, 46, 170, 0.05) -25px 25px;
        }

    </style>


    <link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--[if lt IE 9]>
    <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
</head>

<body id="page-top">
@include('sweet::alert')
<!-- Page Wrapper -->
<div id="wrapper">
    <div class="background"></div>
    <div class="foreground">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="col-xl-12  rounded logo">
                        <img src="{{asset('img/par-servicios-logo-dark.png')}}" class="img-fluid">
                    </div>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-green">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }} 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin/sb-admin-2.min.js') }}"></script>
<script type="text/javascript">

    {{--AJAX GENÉRICO & CONFIRM ALERTS--}}
    //Mensajes de confirmacion
    function  ConfirmAlerts(formName, type)
    {
        this.formName = formName;
        this.type = type;
        this.text = "";
        this.messageButton = "";
        this.action ="";

        if(type.includes("edit"))
        {
            text = "{{__("Confirmar")}}";
            messageButton = "{{__("Confirmar")}}";
            action = "create";
        }
        else if(type.includes("register"))
        {
            text = "{{__("Confirmar")}}";
            messageButton = "{{__("ConfirmButton")}}";
            action = "create";
        }
        else if(type.includes("delete"))
        {
            text = "{{__("Confirmar")}}";
            messageButton = "{{__("ConfirmButton")}}";
            action = "trash";
        }

        var confirmMessage = new ConfirmMessage(this.formName, this.type, this.text , this.messageButton);
        confirmMessage[this.action]();
    }

    function ConfirmMessage(formName, type, text, messageButton)
    {
        this.text = text;
        this.messageButton = messageButton;
        this.formName = formName;
        this.type = type;
    }

    ConfirmMessage.prototype.create = function() {
        var formName = this.formName;

        swal({
            title: "Confirmar",
            text: this.text,
            type: "warning",
            buttons: {
                confirm: {
                    text: '{{__("Confirmar")}}',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                document.getElementById(formName).submit()
            }
        });
    }
    ConfirmMessage.prototype.trash = function()
    {
        var formName = this.formName;
        swal({
            title: '{{__("ConfirmDelete")}}',
            text: this.text,
            type: "warning",
            buttons:{
                confirm: {
                    text : '{{__("Confirmar")}}',
                    className : 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                document.getElementById(formName).submit()
            }
        });

    }
</script>

@stack('sectionScripts_afterLoad')
</body>

</html>

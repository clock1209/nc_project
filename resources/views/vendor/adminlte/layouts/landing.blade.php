<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }} ">
    <meta name="author" content="Sergi Tur Badenas - acacha.org">
    <meta property="og:title" content="Adminlte-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" />
    <link rel="shortcut icon" href="img/X_sola.ico">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script> 
    <title> NC Mueblería WEB 2.0 </title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    

</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation" background="/img/boxed-bg.jpg">

<div id="app">
    <!-- Fixed navbar -->
    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" ><b>NC</b> Mueblería</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a class="active" href="#home" class="smoothScroll">{{ trans('adminlte_lang::message.home') }}</a></li>
                    <li><a href="#desc" class="smoothScroll">{{ trans('Servicios') }}</a></li>
                    <li><a href="#showcase" class="smoothScroll">{{ trans('Productos') }}</a></li>
                    <li><a href="#contact" class="smoothScroll">{{ trans('adminlte_lang::message.contact') }}</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    @else
                        <li><a href="/home">{{ Auth::user()->name }}</a></li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>


    <section id="home" name="home" ></section>
    <div id="headerwrap" style="background-image: url(/img/whitebg.jpg);">
        <div class="container" >
            <div class="row centered">
                <div class="col-lg-12">
                  <!--  <h1>NC <b><a href="https://www.facebook.com/NCmuebleria/">Mueblería</a>--><br>
                    <img class="img-responsive" src="{{ asset('/img/imagen3.jpg') }}">
                    <br><br><br><br><br>
                </div>
            </div>
        </div> <!--/ .container -->
    </div> <!--/ #headerwrap -->


    <section id="desc" name="desc"></section>
    <!-- INTRO WRAP -->
     <div id="intro">
        <div class="container">
            <div class="row centered">
                <h1>{{ trans('Servicios') }}</h1>
                <br>
                <br>
                <div class="col-lg-4">
                    <img src="{{ asset('/img/price.png') }}" alt="">
                    <h3>{{ trans('Venta') }}</h3>
                    <p>Tenemos una gran variedad de artículos en exhibición listos para entrega inmediata.</p>
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('/img/custom.png') }}" alt="">
                    <h3>{{ trans('Pedidos') }}</h3>
                    <p>¿No encontraste lo que buscabas? <br>Nosotros lo fabricamos.</p>
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('/img/tools.png') }}" alt="">
                    <h3>{{ trans('Reparación') }}</h3>
                    <p>Ampliamos la vida útil de tus viejos muebles.</p>
                </div>
            </div>
        </div> <!--/ .container -->
    </div><!--/ #introwrap -->
   

    <div id="showcase" style="background-image: url(/img/boxed-bg.jpg);">
        <div class="container">
            <div class="row">
                <h1 class="centered" style="color: black;">{{ trans('Algunos de nuestros productos') }}</h1>
                <br>
                <div class="col-lg-8 col-lg-offset-2">
                    <img class="img-responsive" src="{{ asset('/img/lista.png') }}">
                </div>
            </div>
            <br>
            <br>
            <br>
        </div><!-- /container -->
    </div> 


    <section id="contact" name="contact"></section>
    <div id="footerwrap">
        <div class="container">
            <div class="col-lg-5">
                <h3>{{ trans('adminlte_lang::message.address') }}</h3>
                <p>
                    Calle Álvaro Obregón #1110,<br/>
                    Colonia La Penal<br/>
                    C.P. 44730<br/>
                    Guadalajara, Jalisco<br/>
                </p>
            </div>

            <div class="col-lg-7">
                <iframe src="https://www.google.com/maps/d/embed?mid=1hJTssjJTiqPLNJ_-wAFjzig6XaE" 
                width="600" height="200" frameborder="0" style="border:0" allowfullscreen>
                </iframe>
            </div>
        </div>
    </div> 
     <div id="c">
        <div class="container">
                <p>Copyright &copy; Elegant Horses Co.</p>
        </div>
    </div> 
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{ asset('/js/app.js') }}"></script> 
<script src="{{ asset('/js/smoothscroll.js') }}"></script>
</body>
</html>

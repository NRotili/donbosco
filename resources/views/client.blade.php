<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CLIENTE - Don Bosco</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>


</head>

<body>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="{{ asset('img/palmera.png') }}" alt="Avatar" class="img-fluid  my-5"
                                    style="width: 80px;" />
                                <h5>{{ Str::upper($cliente->apellido) }}, {{ $cliente->nombre }}</h5>
                                <p>Web Designer</p>
                                {{-- <i class="far fa-edit mb-5"></i> --}}
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Mi información</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">
                                                @if ($cliente->email)
                                                    {{ $cliente->email }}
                                                @else
                                                    Sin datos
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Celular</h6>
                                            <p class="text-muted">{{ $cliente->telcelular }}</p>
                                        </div>
                                    </div>
                                    <h6>Movimientos</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Puntos</h6>
                                            <p class="text-muted">{{ $cliente->puntos }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Última compra</h6>
                                            <p class="text-muted">...</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                      @if ($config->whatsapp)
                                      <a href="https://wa.me/{{ $config->whatsapp }}/"><i
                                              class="fab fa-whatsapp fa-lg me-3"></i></a>
                                  @endif
                                        @if ($config->facebook)
                                            <a href="{{ $config->facebook }}"><i
                                                    class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        @endif
                                        @if ($config->twitter)
                                            
                                        <a href="{{$config->twitter}}"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        @endif

                                        @if ($config->instagram)
                                            
                                        <a href="{{$config->instagram}}"><i class="fab fa-instagram fa-lg me-3"></i></a>
                                        @endif

                                        @if ($config->tiktok)
                                            <a href="{{ $config->tiktok }}"><i
                                                    class="fab fa-tiktok fa-lg me-3"></i></a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
</body>

</html>

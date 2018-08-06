<!DOCTYPE html>

<html>

<head>

    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>



        body{

            /*background: #f5683d;*/

            background: #fff;

            padding-top: 10vh;

        }

        form{

            background: #fff;

        }

        .form-container{

            border-radius: 10px;

            padding: 30px;

            box-shadow: 0 0 10px 0;

        }

        .user-bg{

            width: 60px;

            height: 60px;

            position: absolute;

            top: -35px;

            left: 40%;

        }

        h1{

            text-align: center;

            padding-bottom: 7rem;

            font-weight: 900;

            font-family: arial;

        }

    </style>

</head>

<body>

<section class="container-fluid">

    <h1>Bienvenido al blog Jehova Reina</h1>

    <section class="row justify-content-center">

        <section class="col-12 col-sm-6 col-md-4">

            <img src="{{ asset('assets/frontend/images/user.png') }}" class="user-bg"/>

            <form class="form-container" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf

                <h4 class="text-center pt-4 pb-2">Iniciar Session</h4>
                <div class="form-group">
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus
                           id="email"  placeholder="Juan@example.com">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                           id="password" placeholder="Contraseña">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Recuerdame
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block"> Aceptar</button>
                <a href="{{ route('password.request') }}" class="btn btn-info btn-block">Olvidaste tu password</a>

            </form>

        </section>

    </section>

</section>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

</body>

</html>
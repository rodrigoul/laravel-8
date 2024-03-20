@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu E-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
<<<<<<< HEAD
                            {{ __('Um link de verificação foi enviado ao seu e-mail.') }}
=======
                            {{ __('Um link de verificação foi enviado para o endereço de e-mail.') }}
>>>>>>> 2c0bc5d46be9ac4df8cd044cf00814adbfe1559f
                        </div>
                    @endif

                    {{ __('Antes de continuar, favor verifique seu e-mail.') }}
                    {{ __('Se você não recebeu o e-mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clique aqui para enviar outro') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

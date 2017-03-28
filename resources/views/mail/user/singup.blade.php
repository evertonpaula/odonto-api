@extends('mail.template')

@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="font-size:20px;">
                Parabéns
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Olá <i><strong>{{ $name }}</strong></i>, acabamos de receber sua solicitação de cadastro.
                </p>
                <p>Para ativar sua conta accesse o <a  target="_blank"  href="{{ $link_activated }}"> link </a>, ou copie e cole o endereço abaixo em seu navegador.</p>
                <br>
                <p style="color:#FFF;background-color:#263238;padding:5px;">
                    {{ $link_activated }}
                </p>
            </td>
        </tr>
    </table>
@endsection

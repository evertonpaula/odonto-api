@extends('mail.template')

@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="font-size:18px;">
                Recuperação de acesso.
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Olá <i><strong>{{ $name }}</strong></i>, você esqueceu sua senha?.
                </p>
                <p> Para recuperar o acesso a sua conta acesse o <a target="_blank" href="{{ $link_recover }}">link</a>, ou copie e cole o endereço abaixo em seu navegador. Mas lembre-se ele é válido apenas até <b>{{ $expire_at }}</b> </p>
                <br>
                <p style="color:#FFF;background-color:#263238;padding:5px;">
                    {{ $link_recover }}
                </p>
            </td>
        </tr>
    </table>
@endsection

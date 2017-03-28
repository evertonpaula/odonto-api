@extends('mail.template')

@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="font-size:18px;">
                Atualização em sua conta
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Olá <i><strong>{{ $name }}</strong></i>, uma atualização de senha foi realizada com sucesso.
                </p>
                <p> Caso você não tenha realizado o processo de atualiazação de senha, por favor, entre em contanto com o administrador do sistema.</p>
                <br>
            </td>
        </tr>
    </table>
@endsection

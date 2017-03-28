@extends('mail.template')

@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="font-size:18px;">
                Conta ativada
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Olá <i><strong>{{ $name }}</strong></i>, sua conta foi ativada.
                </p>
                <p> Sua conta foi ativada, porém para ter acesso definitivo o administrador de contas terá que desbloque-lo.</p>
                <br>
            </td>
        </tr>
    </table>
@endsection

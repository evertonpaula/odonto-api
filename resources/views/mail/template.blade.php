<!DOCTYPE html>
<html>
    <title>Odonto Painel</title>
    <head>
        <style>
            body{font-family:Helvetica;}
            * {-webkit-text-size-adjust: none; }
            * {-webkit-font-smoothing: antialiased; }
            a { color:#b2d7ff;font-weight: bold;}
         </style>
    </head>
    <body>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr style="background-color:#263238;">
                            <td align="left" style="font-size:24px;color:#FFF;height:45px;padding:10px;">
                                <strong> OdontoPaiva </strong>
                            </td>
                        </tr>
                        <tr >
                            <td align="right" style="padding:10px;font-size:12px;color:#000;">
                                {{ date('d-m-Y H:i:s') }}
                            </td>
                        </tr>
                    </table>
                    <hr>
                    @yield('content')

                    <br>
                    <table style="font-size:16px;color:#000;" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr style="height:30px;">
                            <td align="left" style="padding:10px;">
                                <b>Att.</b>
                            </td>
                        </tr>
                    </table>

                    <hr>
                    <table style="background-color:#263238;font-size:15px;color:#FFF;" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left" style="padding:10px;">
                                <b> Odontopaiva </b>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px;" align="left"> Rua José Antônio Leme, 41 - Jardim N. América </td>
                        </tr>
                        <tr>
                            <td style="padding:10px;" align="left"> Bragança Paulista - SP </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

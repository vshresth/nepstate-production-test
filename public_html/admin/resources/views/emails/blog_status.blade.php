<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nepstate</title>
</head>

<body style="
      font-family: Arial, sans-serif;
      background-color: #ffffff;
      margin: 0;
      padding: 0;
    ">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#ffffff; padding: 20px 0">
        <tr>
        <tr>
            <td align="center" style="padding-bottom: 20px">
                <img src="https://admin.nepstate.com/images/logo/1723785666.png" alt="Nepstate Logo" style="width: 280px" />
            </td>
        </tr>
        <td align="center">
        <table width="600" height="300" cellpadding="0" cellspacing="0" style="
              background-color: #ffffff;
              border-radius: 50px;
              padding: 10px;
              border: 1px solid #d57e68;
            ">

                <tr>
                    <td style="text-align: center;">
                        <h1>Dear <span style="color: #d57e68;">{{ $name }}</span>,</h1>
                        <p>
                            We are writing to let you know that your blog has been
                            <strong style="color: {{ $status == 'Approved' ? '#28a745' : '#d7263d' }}">
                                {{ strtolower($status) }}
                            </strong>.
                        </p>
                        <p>
                            Thank you for your contribution to Nepstate. Keep sharing your amazing ideas!
                        </p>
                    </td>


            </table>
        </td>
        </tr>
    </table>
</body>

</html>
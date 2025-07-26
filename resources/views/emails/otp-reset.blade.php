<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password OTP</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <img src="https://cdn.discordapp.com/attachments/894919708938223657/1398334023792726186/logo.png?ex=6884fb8b&is=6883aa0b&hm=981f174cdcb4a03a56027890a4feda49f73f74f50601d88ca659875954ce0324&" alt="Logo" width="50" />
            </td>
        </tr>
        <tr>
            <td align="center">
                <table width="500" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; padding: 30px;">
                    <tr>
                        <td align="center">
                            <h2 style="color: #333;">Verifikasi Reset Password</h2>
                            <p style="color: #555;">Gunakan kode berikut untuk mereset password Anda:</p>
                            <p
                                style="font-size: 32px; font-weight: bold; letter-spacing: 4px; background-color: #f0f0f0; padding: 16px 24px; border-radius: 8px; display: inline-block; margin: 24px 0;">
                                {{ $otp }}
                            </p>
                            <p style="color: #888;">
                                Kode kamu akan kadaluwarsa dalam 2 menit.
                            </p>
                            <p style="font-size: 13px; color: #999; margin-top: 10px;">
                                Sistem Web Karyawan GLI by PT. Global Lintas Iramada Network
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 10px 0; font-size: 12px; color: #999;">
                <p>Jika Anda tidak meminta reset password, silakan abaikan email ini.</p>
                <p>&copy; {{ date('Y') }} Sistem Web Karyawan GLI by PT. Global Lintas Iramada Network. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>

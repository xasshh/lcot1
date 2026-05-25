<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify Your Email — LCOT</title>
</head>
<body style="margin:0;padding:0;background:#0f172a;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#0f172a;padding:48px 20px;">
  <tr>
    <td align="center">
      <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

        {{-- Brand badge --}}
        <tr>
          <td align="center" style="padding-bottom:24px;">
            <span style="display:inline-block;background:rgba(220,38,38,0.1);border:1px solid rgba(220,38,38,0.25);border-radius:999px;padding:5px 18px;font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#dc2626;">
              Life College of Theology &bull; Abuja
            </span>
          </td>
        </tr>

        {{-- Card --}}
        <tr>
          <td style="background:#1e293b;border-radius:16px;padding:44px 40px;border:1px solid rgba(255,255,255,0.07);box-shadow:0 24px 64px rgba(0,0,0,0.45);">

            {{-- Icon --}}
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" style="padding-bottom:28px;">
                  <table cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" valign="middle" width="60" height="60" style="background:rgba(220,38,38,0.12);border-radius:50%;text-align:center;">
                        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            {{-- Heading --}}
            <h1 style="margin:0 0 12px;font-size:24px;font-weight:800;color:#f1f5f9;text-align:center;letter-spacing:-0.02em;line-height:1.2;">
              Verify Your Email Address
            </h1>

            <p style="margin:0 0 6px;font-size:15px;color:#94a3b8;text-align:center;line-height:1.6;">
              Welcome to LCOT, <strong style="color:#e2e8f0;">{{ $user->name }}</strong>!
            </p>
            <p style="margin:0 0 36px;font-size:14px;color:#64748b;text-align:center;line-height:1.7;">
              Please verify your email address to activate your student account and access the portal.
            </p>

            {{-- CTA Button --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:36px;">
              <tr>
                <td align="center">
                  <a href="{{ $url }}"
                     style="display:inline-block;background:linear-gradient(135deg,#dc2626,#b91c1c);color:#ffffff;text-decoration:none;font-size:15px;font-weight:700;letter-spacing:0.02em;padding:15px 40px;border-radius:8px;box-shadow:0 4px 18px rgba(220,38,38,0.38);">
                    Verify Email Address
                  </a>
                </td>
              </tr>
            </table>

            {{-- Expiry notice --}}
            <p style="margin:0 0 28px;font-size:13px;color:#475569;text-align:center;line-height:1.7;">
              This link expires in <strong style="color:#94a3b8;">60 minutes</strong>.
              If you did not create an account, no further action is required.
            </p>

            {{-- Divider --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
              <tr><td style="border-top:1px solid rgba(255,255,255,0.06);font-size:1px;line-height:1px;">&nbsp;</td></tr>
            </table>

            {{-- Fallback link --}}
            <p style="margin:0;font-size:12px;color:#475569;text-align:center;line-height:1.8;">
              Button not working? Copy and paste this URL into your browser:<br>
              <a href="{{ $url }}" style="color:#dc2626;word-break:break-all;font-size:11px;">{{ $url }}</a>
            </p>

          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td align="center" style="padding:28px 0 0;">
            <p style="margin:0;font-size:11px;color:#334155;line-height:1.7;">
              &copy; {{ date('Y') }} Life College of Theology, Abuja. All rights reserved.<br>
              This is an automated message &mdash; please do not reply.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>

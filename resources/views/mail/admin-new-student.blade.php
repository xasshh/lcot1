<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Student Registration — LCOT</title>
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
              Staff Notification &bull; LCOT
            </span>
          </td>
        </tr>

        {{-- Card --}}
        <tr>
          <td style="background:#1e293b;border-radius:16px;padding:44px 40px;border:1px solid rgba(255,255,255,0.07);box-shadow:0 24px 64px rgba(0,0,0,0.45);">

            {{-- Title --}}
            <p style="margin:0 0 8px;font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#dc2626;">
              New Registration
            </p>
            <h1 style="margin:0 0 6px;font-size:22px;font-weight:800;color:#f1f5f9;letter-spacing:-0.02em;line-height:1.2;">
              A new student has registered
            </h1>
            <p style="margin:0 0 32px;font-size:13px;color:#64748b;">
              Registered on {{ $registeredAt }}
            </p>

            {{-- Student details table --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:32px;border-radius:10px;overflow:hidden;border:1px solid rgba(255,255,255,0.07);">

              {{-- Table header --}}
              <tr>
                <td colspan="2" style="background:rgba(220,38,38,0.08);padding:10px 16px;font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#dc2626;border-bottom:1px solid rgba(255,255,255,0.07);">
                  Student Details
                </td>
              </tr>

              <tr>
                <td width="38%" style="padding:13px 16px;font-size:12px;font-weight:600;color:#64748b;border-bottom:1px solid rgba(255,255,255,0.05);">Full Name</td>
                <td style="padding:13px 16px;font-size:14px;font-weight:600;color:#e2e8f0;border-bottom:1px solid rgba(255,255,255,0.05);">{{ $student->name }}</td>
              </tr>

              <tr>
                <td style="padding:13px 16px;font-size:12px;font-weight:600;color:#64748b;border-bottom:1px solid rgba(255,255,255,0.05);">Email Address</td>
                <td style="padding:13px 16px;font-size:14px;color:#e2e8f0;border-bottom:1px solid rgba(255,255,255,0.05);">{{ $student->email }}</td>
              </tr>

              <tr>
                <td style="padding:13px 16px;font-size:12px;font-weight:600;color:#64748b;border-bottom:1px solid rgba(255,255,255,0.05);">Matric Number</td>
                <td style="padding:13px 16px;font-size:14px;font-family:monospace;color:#e2e8f0;border-bottom:1px solid rgba(255,255,255,0.05);">{{ $student->matric_number ?? '—' }}</td>
              </tr>

              <tr>
                <td style="padding:13px 16px;font-size:12px;font-weight:600;color:#64748b;border-bottom:1px solid rgba(255,255,255,0.05);">Program</td>
                <td style="padding:13px 16px;font-size:14px;color:#e2e8f0;border-bottom:1px solid rgba(255,255,255,0.05);">{{ $student->program_taken ?? '—' }}</td>
              </tr>

              <tr>
                <td style="padding:13px 16px;font-size:12px;font-weight:600;color:#64748b;">Study Center</td>
                <td style="padding:13px 16px;font-size:14px;color:#e2e8f0;">{{ $student->program_center ?? '—' }}</td>
              </tr>

            </table>

            {{-- Body text --}}
            <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.7;">
              Please log in to the admin panel to review this registration, assign courses, and follow up with the student if needed.
            </p>

            {{-- Divider --}}
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
              <tr><td style="border-top:1px solid rgba(255,255,255,0.06);font-size:1px;line-height:1px;">&nbsp;</td></tr>
            </table>

            <p style="margin:0;font-size:12px;color:#475569;line-height:1.6;">
              This is an automated notification from the LCOT Student Registration System. Do not reply to this email.
            </p>

          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td align="center" style="padding:28px 0 0;">
            <p style="margin:0;font-size:11px;color:#334155;line-height:1.7;">
              &copy; {{ date('Y') }} Life College of Theology, Abuja. All rights reserved.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>

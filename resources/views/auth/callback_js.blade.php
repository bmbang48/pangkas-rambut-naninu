<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authenticating...</title>
</head>
<body style="background: #0f0f11; color: white; font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh;">
    <div style="text-align: center;">
        <div style="border: 4px solid rgba(255,255,255,0.1); border-top: 4px solid #b91c1c; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 0 auto 20px;"></div>
        <p>Authentication Successful. Closing window...</p>
    </div>

    <script>
        try {
            if (window.opener) {
                const message = {
                    type: @isset($error) 'auth_error' @else 'auth_success' @endisset,
                    token: @json($token ?? ''),
                    message: @json($error ?? '')
                };

                // Notify parent of the error or success
                window.opener.postMessage(message, window.location.origin);
                
                // Close this popup
                setTimeout(() => window.close(), 500);
            } else {
                // Fallback for non-popup flows
                window.location.href = @isset($error) '/login' @else '/dashboard' @endisset;
            }
        } catch (e) {
            console.error('Popup error:', e);
            window.close(); // Safety close
        }
    </script>

    <style>
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</body>
</html>

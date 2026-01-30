<body style="background:#121212; color:white; font-family:sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; margin:0;">
    <div style="max-width:400px; width:90%; background:#1e1e1e; padding:30px; border-radius:12px; border: 1px solid #333; text-align:center; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        
        <h2 style="margin-bottom: 10px;">Verify Account</h2>
        <p style="color: #888; font-size: 14px; margin-bottom: 20px;">
            We sent a code to <br> 
            <span style="color: #4ade80;">{{ $email }}</span>
        </p>

        @if(session('success'))
            <div style="background: rgba(74, 222, 128, 0.1); color: #4ade80; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 13px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(248, 113, 113, 0.1); color: #f87171; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 13px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('student.otp.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            
            <input type="text" name="otp" maxlength="6" placeholder="000000" required
                style="background:#2d2d2d; border: 1px solid #444; color:white; font-size:32px; text-align:center; width:100%; padding:10px; border-radius:8px; letter-spacing:8px; margin-bottom:20px; outline:none; box-sizing: border-box;">
            
            <button type="submit" style="background:#4ade80; color: #121212; font-weight: bold; width:100%; padding:14px; border:none; border-radius: 8px; cursor:pointer; font-size: 16px; transition: 0.3s;">
                VERIFY NOW
            </button>
        </form>

        <div style="margin-top:25px; font-size:14px; color: #888;">
            <span id="timer-box">
                Didn't get the code? Wait <span id="timer" style="color:#4ade80; font-weight:bold;">60</span>s
            </span>

            <a id="resend-link" href="{{ route('student.otp.resend', ['email' => $email]) }}" 
               style="color:#4ade80; font-weight:bold; text-decoration:none; display:none;">
               Resend OTP
            </a>
        </div>
    </div>

    <script>
        let timeLeft = 60;
        const timerElement = document.getElementById('timer');
        const timerBox = document.getElementById('timer-box');
        const resendLink = document.getElementById('resend-link');

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.innerText = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerBox.style.display = 'none';    // Hide the "Wait 60s" text
                resendLink.style.display = 'inline'; // Show the "Resend OTP" link
            }
        }, 1000);
    </script>
</body>
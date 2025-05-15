<form method="POST" action="/send-otp">
    @csrf
    <input type="text" name="phone_number" placeholder="Enter Phone Number" required>
    <button type="submit">Send OTP</button>
</form>
<h1>Reset Password</h1>
<form method="post" action="{{ route('reset_password_submit', ['token' => $token, 'email' => $email]) }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="password" name="password" placeholder="New Password">
    <input type="password" name="confirm_password" placeholder="Confirm Password">
    <button type="submit">Reset Password</button>
</form>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to our store</h1>
    <form action="{{ route('idram.initiate') }}" method="POST">
        @csrf
        <input type="number" name="amount" placeholder="Enter amount">
        <button type="submit">Pay with Idram</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Idram Payment</title>
</head>
<body>
    <form action="{{ route('idram.initiate') }}" method="POST">
        @csrf
        <input type="text" name="amount" placeholder="Amount">
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="bill_no" placeholder="Bill Number">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="trans_id" placeholder="Transaction ID">
        <button type="submit">Pay with Idram</button>
    </form>
</body>
</html>

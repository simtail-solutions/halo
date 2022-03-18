<html>
<head></head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap');
    body {
        background: #d2f2fc;
        margin: auto;
        font-family: 'Lato', sans-serif;
    }
    header {
        height: 75px;
        display: flex;
        vertical-align: middle;
        align: center;
    }
    header img {
        float: none;
        margin: auto;
        width: 150px;
    }
    .card {
        background: #fff;
        box-shadow: 2px 4px 4px rgba(0,0,0,0.15);
        float: none;
        margin: auto;
        max-width: 600px;
        padding: 2rem;
    }
</style>
<body>
<header>
    <img src="http://127.0.0.1:8000/img/halo-finance.png">
</header>
<div class="card">
<h2>Hello</h2> <br><br> 
<table>
    <tr>
        <td colspan="2">You received a message from <strong>{{ $businessName }}</strong></td>
    </tr>
    <tr>
        <th>Contact Name:</th>
        <td>{{ $firstName }} {{ $lastName }}</td>
    </tr>
    <tr>
        <th>Email:</th>
        <td><a href="mailto:{{$email}}">{{ $email }}</a></td>
    </tr>
    <tr>
        <th>Phone:</th>
        <td><a href="tel:{{ $phone }}">{{ $phone }}</a></td>
    </tr>
    <tr>
        <th>Message:</th>
        <td>{!! $form_message !!}</td>
    </tr>
</table>
</div>
</body>
</html>

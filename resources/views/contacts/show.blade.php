
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Show</h1>
    <p>name: {{$contact['name']}}</p>
    <p>phone: {{$contact['phone']}}</p>
    <div>
        <a href='{{route('contacts.index')}}'>All Contacts</a>
        <a href='{{route('contacts.show',1)}}'>Show Contact</a>
    </div>

</body>
</html>

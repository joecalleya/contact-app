<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Contacts App</h1>
    <div>
        <a href='{{route('contacts.index')}}'>All Contacts</a>
        <a href='{{route('contacts.create')}}'>Create Contact</a>
        <a href='{{route('contacts.show',1)}}'>Show Contact</a>
    </div>

</body>
</html>

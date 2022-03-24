<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Informacion de la Stock </h1>
    <ul>
        <li>ID :{{ $info->id}}</li>
        <li>NAME:{{ $info->name}}</li>
        <li>PRICE:{{ $info->price}}</li>
        <li>
            <h2>STOCK:{{ $info->stock}}</h2>
        </li>
        <li>REFERENCE:{{ $info->reference}}</li>
        <li>DESCRIPTION:{{ $info->description}}</li>
        <li>STATUS:{{ $info->status}}</li>
        <li>CATEGORY:{{ $info->category}}</li>
        <li>IMAGE{{ $info->image}}</li>
        <li>CREATE_AT:{{ $info->created_at}}</li>
        <li>UPDATED_AT{{ $info->updated_at}}</li>
</ul>

</body>
</html>
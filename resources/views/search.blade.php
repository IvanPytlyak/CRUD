<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styles.css" rel="stylesheet"> 
    <title>Document</title>
</head>
<body class="search-results-page">
    <form action="{{route('search')}}" method="post">
        @csrf
        <label for="searchQuery">Поиск по имени или фамилии:</label>
        <input type="text" name="searchQuery" id="searchQuery">
        <button type="submit">Поиск</button>
    </form>
    @foreach ($users as $user)
    <ul>
       <ol> Имя:{{$user->name}}</ol>
       <ol> Фамилия:{{$user->surname}}</ol>
       <ol> Город:{{$user->name_of_city}}</ol>
       <ol><img src="{{ $user->getUser($user->id) }}" alt="User Image" width="100" height="100"></ol>
    </ul>
    @endforeach
</body>
</html>
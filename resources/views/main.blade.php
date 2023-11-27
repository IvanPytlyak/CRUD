<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/main.css" rel="stylesheet"> 
    <title>Document</title>
</head>
<body>

    <a href="{{route('users.index')}}">Пользователи</a>

    <h1>Счетчик обновлений страницы: {{ $count }}</h1>
    <a href="{{ route('main') }}">Перейти к счетчику</a>

    <div class="wrapper">
            <h2>Список городов</h2>               

            <form action="{{route('sort')}}" method="post">
                @csrf
                    <div class="sortform">
                        <div class="pole">
                            <h3>Поле сортировки</h3>
                            <span>
                                <input type="radio" name="sort_sity" value="sort_id" checked="">
                                <b>id</b>
                            </span>
                            <span>
                                <input type="radio" name="sort_sity" value="sort_sity">
                                <b>Название Города</b>
                            </span>
                            <span>
                                <input type="radio" name="sort_sity" value="sort_rangir">
                                <b>Индекс Сортировки</b>
                            </span>
                        </div>
                        <div class="napr">
                            <h3>Направление сортировки</h3>
                            <span>
                                <input type="radio" name="sort_order_by" value="sort_asc" checked="">
                                <b>Возрастание</b>
                            </span>
                            <span>
                                <input type="radio" name="sort_order_by" value="sort_desc">
                                <b>Убывание</b>
                            </span>	
                        </div>
                    </div>

                        <button type="submit">Сортировать</button>
                        
                        <a href="{{route('main')}}}">Отмена</a>
                    
            </form>



            <form action="{{route('city')}}" method="post">
            @csrf
            <label for="inputData">Введите данные:</label>
            <input type="text" id="inputCity" name="inputCity">
            <input type="number" id="inputIndex" name="inputIndex">
            <input type="submit" value="Добавить">
            </form>


            @foreach ($cities as $city)


        <div class="city">

                <h2>

                <ul>
                    <li>{{ $city->name }} - {{ $city->index }}</li>
                </ul>

                </h2>

                <form action="{{route('delete', ['id'=> $city->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Удалить">
                </form>

                <form action="{{route('edit', ['city' => $city->id])}}" method="post">
                @csrf

                @method('PUT')

                <label for="city">Город:</label>
                <input type="text" id="city" name="city"  value="{{ $city->name }}" required>

                <label for="index">Индекс:</label>
                <input type="text" id="index" name="index" value="{{ $city->index }}" required>

                <button type="submit">Изменить данные</button>
            </form>

        </div>


@endforeach
</div>
</body>

</html>
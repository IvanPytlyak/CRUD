<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styles.css" rel="stylesheet"> 
    <title>Document</title>
</head>
<body class="users-page">
    <h1>Счетчик обновлений страницы: {{ $count }}</h1>
    <a href="{{ route('users.index') }}">Перейти к счетчику</a>

    
    <h2>Список пользователей</h2>               
        
        <form action="{{route('sortUsers')}}" method="post">
            @csrf
                <div class="sortform">
                    <div class="pole">
                        <h3>Поле сортировки</h3>
                        <span>
                            <input type="radio" name="sort_user" value="sort_id" checked="">
                            <b>id</b>
                        </span>
                        <span>
                            <input type="radio" name="sort_user" value="sort_name">
                            <b>Имя</b>
                        </span>
                        <span>
                            <input type="radio" name="sort_user" value="sort_surname">
                            <b>Фамилия</b>
                        </span>
                        <span>
                            <input type="radio" name="sort_user" value="sort_city">
                            <b>По городу</b>
                        </span>
                    </div>
                    <div class="napr">
                        <h3>Направление сортировки</h3>
                        <span>
                            <input type="radio" name="sort_order_by_sort_user" value="sort_asc" checked="">
                            <b>Возрастание</b>
                        </span>
                        <span>
                            <input type="radio" name="sort_order_by_sort_user" value="sort_desc">
                            <b>Убывание</b>
                        </span>	
                    </div>
                </div>

                    <button type="submit">Сортировать</button>
                   
                    <a href="{{route('users.index')}}}">Отмена</a>
                
        </form>


        
    <form action="{{route('all_users')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="inputData">Введите данные:</label>
        <input type="text" placeholder="Name" id="inputName" name="inputName">
        <input type="text" placeholder="Surname" id="inputSurname" name="inputSurname">
        <!-- Выпадающий список -->
            <label for="citySelect">Выберите город:</label>
            <select id="citySelect" name="citySelect">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
                <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <label class="btn btn-default btn-file">
                        <label for="image" style="border: 1px solid gray; padding: 5px; display: inline-block;">Выберите изображение</label>
                        <input type="file" style="display: none;" name="image" id="image">
                    </label>
            <input type="submit" value="Добавить">
    </form>

    @foreach ($users as $user)

    <h2>        
        <ul>
            <li>{{ $user->name }}  {{ $user->surname }} - {{$user->name_of_city}}</li>
            <li><img src="{{ $user->getUser($user->id) }}" alt="User Image" width="100" height="100"></li>
            <li> <a href="{{route('users.edit', $user)}}">Редактировать</a></li>
        </ul>      
    </h2>
    
    <form action="{{route('users.destroy', $user->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Удалить">
    </form>

    @endforeach



    

</body>

</html>
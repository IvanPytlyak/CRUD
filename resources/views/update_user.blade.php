<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/styles.css" rel="stylesheet"> 
    <title>Document</title>
</head>
<body>
    
   
    

      


    <form action="{{route('edit_user', ['user' => $user->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name_edit">Имя:</label>
        <input type="text" id="name_edit" name="name_edit"  value="{{ $user->name }}" required>

        <label for="surname_edit">Фамилия:</label>
        <input type="text" id="surname_edit" name="surname_edit" value="{{ $user->surname }}" required>
        
        <label for="city_edit">Выберите город:</label>
            <select id="city_edit" name="city_edit">
                @foreach($cities as $city)
                    <option value="{{ $city->name}}">{{ $city->name }}</option>
                @endforeach
            </select>


        <label for="image_edit" class="col-sm-2 col-form-label">Картинка: </label>
        <label class="btn btn-default btn-file">
            <label for="image_edit" style="border: 1px solid gray; padding: 5px; display: inline-block;">Выберите изображение</label>
            <input type="file" style="display: none;" name="image_edit" id="image_edit">
        </label>

        <button type="submit">Изменить данные</button>
    </form>




</body>
</html>
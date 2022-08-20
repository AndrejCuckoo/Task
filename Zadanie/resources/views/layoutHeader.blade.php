<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <h5 class="my-0 mr-md-auto font-weight-normal">Журнал</h5>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 link-secondary">Главная страница</a></li>
            <li><a href="/StudCreate" class="nav-link px-2 link-secondary">Создание студента</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Создание дисциплины</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Привязка студента к дисциплине</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Отображение всех студентов по дисциплине</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Проставление оценки</a></li>
        </ul>
    </header>
</div>

<div class="container">
    @yield('main_content')
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Проверка вакансии</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl">
    <div class="flex flex-col mt-8">
        @if ($vacancies)
            @foreach($vacancies as $vacancy)
                <div class="mb-2 w-full h-[250px] sm:h-[200px] p-6 border border-gray-200 rounded-lg shadow flex flex-col sm:flex-row sm:justify-between"">
                    <div class="flex flex-col justify-between h-[200px] sm:h-[150px]">
                        <h5 class="font-semibold text-2xl sm:font-bold tracking-tight text-blue-600">{{$vacancy->name_job}}</h5>
                        <div>
                            <p class="font-normal text-sky-900">Место работы: {{$vacancy->place}}</p>
                            <p class="font-normal text-sky-900">Работодатель: {{$vacancy->getcompany->company}}</p>
                        </div>
                        <h4 class="font-bold text-sky-900">Зарплата: {{$vacancy->paycheck}} руб.</h4>
                    </div>
                    <div class="flex flex-row sm:flex-col justify-between mt-3 text-xs font-medium">
                        <a href="{{Route('showThisVacancy', [$vacancy->vacancy_id])}}"
                           class="justify-center w-[100px] sm:w-[180px] inline-flex items-center px-1 py-1 sm:text-sm sm:px-3 sm:py-2 text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Подробнее
                        </a>
                        <a href="{{Route('confirm', [$vacancy->vacancy_id])}}"
                           class="justify-center w-[100px] sm:w-[180px] inline-flex items-center px-1 py-1 sm:text-sm sm:px-3 sm:py-2 text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <button>Принять</button>
                        </a>
                        <a href="{{Route('showPageComments', [$vacancy->vacancy_id])}}"
                           class="justify-center w-[100px] sm:w-[180px] inline-flex items-center px-1 py-1 sm:text-sm sm:px-3 sm:py-2 text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <button>Отказать</button>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@include('footer')
</body>
</html>

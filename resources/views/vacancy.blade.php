<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вакансии</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="vacancy my-8 mx-auto max-w-screen-xl">
    <span class="mx-2 xl:mx-auto text-3xl font-bold text-blue-600">Вакансии</span>
    <form class="mt-4 mx-2 xl:mx-auto" action="{{Route('search')}}" method="get">
        <label for="search" class="mb-4 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" id="search" name="search" class="mb-2 block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Введите название профессии..." required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Поиск</button>
        </div>
    </form>
    @if($errors->any())
        <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">{{$errors->first()}}</span></div>
    @endif
    <span class="mx-2 xl:mx-auto text-xl font-semibold text-blue-600">Фильтры</span>
    <form action="filters" method="get">
        <span class="mx-2 xl:mx-auto text-lg font-normal text-sky-900">Город</span>
        <select name="place"
                class="mt-4 text-blue-700 border-1 border-blue-700 border hover:border-blue-900 hover:border-2 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center">
            <option class="block px-4 py-2 hover:bg-gray-100"> </option>
            @foreach($citys as $city)
                <option class="block px-4 py-2 hover:bg-gray-100">
                    {{$city->place}}
                </option>
            @endforeach
        </select>
        <span class="mx-2 xl:mx-auto text-lg font-normal text-sky-900 xl:ml-8">Зарплата</span>
        <input type="number" class="bg-white border border-blue-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-[300px] p-2.5" name="prices1" placeholder="от">
        <input type="number" class="bg-white border border-blue-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-[300px] p-2.5" name="prices2" placeholder="до">
        <button type="submit" class="mb-4 w-[150px] justify-center items-center py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Применить</button>
    </form>
    <div class="flex flex-wrap my-4 ml-2 lg:ml-auto justify-center">
        @if ($vacancies)
            @foreach($vacancies as $vacancy)
                <div class="mb-2 mr-3 w-[350px] h-[300px] p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex flex-col justify-between h-[250px]">
                    <h5 class="text-2xl font-bold tracking-tight text-blue-600">{{$vacancy->name_job}}</h5>
                        <div>
                            <p class="font-normal text-sky-900">Место работы: {{$vacancy->place}}</p>
                            <p class="font-normal text-sky-900">Работодатель: {{$vacancy->getcompany->company}}</p>
                        </div>
                        <h4 class="font-bold text-sky-900">Зарплата: {{$vacancy->paycheck}} руб.</h4>
                        <a href="{{Route('showThisVacancy', [$vacancy->vacancy_id])}}" class="w-[150px] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Подробнее
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="pagination flex justify-center">{{$vacancies->appends(['search'=>request()->search])->links()}}</div>
</div>
@include('footer')
</body>
</html>

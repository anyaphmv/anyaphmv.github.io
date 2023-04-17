<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$vacancies->name_job}}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="xl:mx-auto max-w-screen-xl mx-2">
    <div class="flex flex-col sm:flex-row my-8">
        <div class="flex flex-col sm:mr-2 w-full md:w-full">
            <div class="mainInfo mb-4 border border-1 border-blue-600 border-opacity-50 max-h-[500px] shadow shadow-blue-500">
                <div class="txt flex flex-col m-5">
                    <div class="flex flex-col md:flex-row justify-between">
                        <span class="text-blue-600 font-bold text-3xl mb-1">{{$vacancies->name_job}}</span>
                        <h4 class="font-bold @if($vacancies->status_id == '1')text-green-400 @else text-red-600 @endif">
                            Статус: {{$vacancies->getstatus->status}}</h4>
                    </div>
                    <span class="text-sky-900 font-semibold text-2xl mb-3">Зарплата: {{$vacancies->paycheck}} руб.</span>
                    <span class="text-sky-900 font-md text-base">Место работы: {{$vacancies->place}}</span>
                    <span class="text-sky-900 font-md text-base mb-3">Работодатель: {{$vacancies->getcompany->company}}</span>
                    <a href=""
                       class="w-[120px] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Откликнуться
                    </a>
                </div>
            </div>
            <div class="discription mb-4 sm:mb-0">
                <div class="txt flex flex-col">
                    <span class="text-sky-900 font-semibold text-lg mb-1">Требования к исполнителю:</span>
                    <span class="text-sky-900 font-normal text-lg mb-2">{{$vacancies->discription}}</span>
                    <span class="text-sky-900 font-semibold text-lg">Контактный номер: {{$vacancies->getphones->phone}}</span>
                </div>
            </div>
        </div>
        <div class="banner w-full md:max-w-sm max-h-[220px] p-6 bg-white border border-gray-200 rounded-lg shadow">
            <svg class="w-10 h-10 mb-2 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path><path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path></svg>
            <a href="#">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">У Вас есть вопросы?</h5>
            </a>
            <p class="mb-2 font-normal text-gray-500">На сайте есть страница, где Вы можете ознакомиться со свей инфорамцией о нас.</p>
            <a href="{{Route('aboutPage')}}" class="inline-flex items-center text-blue-600 hover:underline">
                Ознакомиться с информацией
            </a>
        </div>
    </div>

    <div class="similars">
        <span class="text-sky-900 font-semibold text-2xl">Список вакансий</span>
        <div class="flex flex-wrap my-2 mr-2">
            @if ($similars)
                @foreach($similars as $similar)
                    <div class="flex flex-col justify-between mb-2 mr-2 w-full sm:w-[300px] max-h-[400px] p-4 bg-white border border-gray-200 rounded-lg shadow">
                        <h5 class="text-2xl font-bold tracking-tight text-blue-600 mb-2">{{$similar->name_job}}</h5>
                        <div class="mb-2">
                            <p class="font-normal text-sky-900">Место: {{$similar->place}}</p>
                            <p class="font-normal text-sky-900">Работодатель: {{$similar->getcompany->company}}</p>
                        </div>
                        <h4 class="font-bold text-sky-900 mb-2">Зарплата: {{$similar->paycheck}} руб.</h4>
                        <a href="{{Route('showThisVacancy', [$similar->vacancy_id])}}" class="w-[150px] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Подробнее
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@include('footer')
</body>
</html>

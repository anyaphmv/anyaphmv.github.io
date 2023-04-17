<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мои вакансии</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl">
    @if($errors->any())
        <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">{{$errors->first()}}</span></div>
    @endif
    <div class="my-4 text-2xl font-semibold tracking-tight text-blue-600 md:text-4xl md:font-bold">Мои вакансии</div>
    <div class="flex flex-col">
        @if ($myVacancies)
            @foreach($myVacancies as $vacancy)
                <div class="mb-2 w-full h-[300px] sm:h-[230px] p-6 border border-gray-200 rounded-lg shadow flex flex-col sm:flex-row sm:justify-between">
                    <div class="flex flex-col justify-between h-[200px] sm:h-[170px]">
                        <div class="flex flex-row">
                        <h4 class="font-semibold sm:font-bold @if($vacancy->status_id == '1')text-green-400 @elseif($vacancy->status_id == '3') text-orange-300 @else text-red-600 @endif">Статус: {{$vacancy->getstatus->status}}</h4>
                        @if($vacancy->status_id == 2)
                                <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="text-xs sm:text-base underline ml-2 text-sky-900 hover:text-red-400 hover:no-underline">Комментарий модератора!</button>
                                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Комментарий модератора
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="defaultModal">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div class="p-6 space-y-6">
                                                <p class="text-base leading-relaxed text-gray-500">
                                                 {{$vacancy->comments}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endif
                        </div>
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
                        <a href="{{Route('showPageUpdateVacancy', [$vacancy->vacancy_id, Auth::user()->id])}}"
                           class="justify-center w-[100px] sm:w-[180px] inline-flex items-center px-1 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Изменить вакансию
                        </a>
                        <button onclick="return confirm('Вы хотите удалить эту вакансию?')" class="btn btn-outline-danger">
                            <a href="{{route('deleteVacancy', [$vacancy->vacancy_id, Auth::user()->id])}}" class="justify-center w-[100px] sm:w-[180px] inline-flex items-center px-1 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Удалить вакансию
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@include('footer')
</body>
</html>

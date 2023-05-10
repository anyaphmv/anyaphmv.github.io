<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Подобранные резюме</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl my-8">
    <div class="mt-8 mb-4 text-xl font-semibold tracking-tight text-blue-600 md:text-4xl">Подобранные резюме для вакансии "{{$vacancies->name_job}}"</div>
    <ul>
        @if($resumes)
            @foreach($resumes as $res)
                <li class="flex flex-col h-[150px] sm:h-auto sm:flex-row justify-between mb-2 text-sky-900 border-bottom border-sky-400">
                    <div class="w-[205px] lg:w-[250px]">{{$res->FIO}}</div>
                    <div class="flex w-[250px] md:justify-center">{{$res->Staff}}</div>
                    <a class="hover:underline hover:font-semibold" href="{{Route('thisResume',[$res->resume_id])}}">Подробнее</a>
                    <div class="sm:pl-4 md:px-auto">
                        <a href="{{Route('AgreeRes',[$res->resume_id, $vacancies->vacancy_id])}}" class="justify-center w-[100px] sm:w-[100px] inline-flex items-center px-1 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-green-500 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Подвердить</a>
                        <a href="{{Route('refusalRes',[$res->resume_id, $vacancies->vacancy_id])}}" class="justify-center w-[100px] sm:w-[100px] inline-flex items-center px-1 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Отказать</a>
                        <button type="button" data-modal-target="addcom-{{$res->resume_id}}" data-modal-toggle="addcom-{{$res->resume_id}}" class="mt-1 sm:mt-0 justify-center w-[100px] sm:w-[100px] inline-flex items-center px-1 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-orange-500 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">Доработать</button>
                        <div id="addcom-{{$res->resume_id}}" tabindex="-1" aria-hidden="true" class="normal-case fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                            <div class="relative w-full h-full max-w-2xl md:h-auto down">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">Комментарий для доработки резюме</h3>
                                        <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="addcom-{{$res->resume_id}}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <form method="Post" action="{{Route('revisionResum',[$res->resume_id,$vacancies->vacancy_id])}}">
                                        <div class="flex flex-col m-3">
                                            <input type="text" name="comment" class="font-normal p-3 w-full h-[35px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                                            <button type="submit"
                                                    class="my-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Готово
                                            </button>
                                        </div>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
@include('footer')
</body>
</html>

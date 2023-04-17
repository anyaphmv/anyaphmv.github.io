<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Комментарий к вакансии</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl">
    <form method="POST" action="{{Route('refusalVacancy', [$vacancies->vacancy_id])}}">
        <div class="p-6 space-y-6">
            <p class="text-base leading-relaxed text-gray-500">
                Оставьте свой комментарий о том, что в данной вакансии не так. Описать
                следует подробно, чтобы автор понял в чем заключалась проблема.
            </p>
            <input type="text" name="comments"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
            <button data-modal-hide="staticModal" type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Отправить
            </button>
        </div>
        @csrf
    </form>
</div>
@include('footer')
</body>
</html>

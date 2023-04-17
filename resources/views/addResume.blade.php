<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавление резюме</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl">
    <h1 class="mt-8 mb-4 text-xl font-semibold tracking-tight text-blue-600 md:text-4xl">Добавить резюме</h1>
    @include('site')
    <form action="{{Route('AddResume')}}" method="Post">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name_job" class="block mb-2 text-sm font-medium text-gray-900">ФИО</label>
                <input type="text" name="FIO"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       placeholder="Иванов Иван Иванович">
            </div>
            <div>
                <label for="paycheck" class="block mb-2 text-sm font-medium text-gray-900">Стаж</label>
                <input type="number" name="Stage"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       placeholder="5">
            </div>
            <div>
                <label for="place" class="block mb-2 text-sm font-medium text-gray-900">Профессия</label>
                <input type="text" name="Staff"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       placeholder="Сварщик 5 разряда">
            </div>
            <div>
                <label for="place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Телефон</label>
                <input type="text" name="Phone"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       placeholder="89999999999">
            </div>
        </div>
        <div class="mb-6">
            <label for="discription" class="block mb-2 text-sm font-medium text-gray-900">Описание</label>
            <input type="text" name="Discription"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   placeholder="Образование: МГУ, бакалавр, сварщик. Квалификация: сварщик 5 разряда. Качества: пунктуальность, целеустремленность, работоспособность и увлеченность." >
        </div>
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Добавить
        </button>
        @csrf
    </form>
</div>
@include('footer')
</body>
</html>

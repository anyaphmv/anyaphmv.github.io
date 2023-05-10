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
<div class="mx-2 xl:mx-auto max-w-screen-xl">
    <div class="mt-8 mb-4 text-xl font-semibold tracking-tight text-blue-600 md:text-4xl">Подобранные резюме</div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Вакансия
                </th>
                <th scope="col" class="px-6 py-3">
                    Действие
                </th>
            </tr>
            </thead>
            @if($vacs)
                @foreach($vacs as $vac)
                        <tbody>
                        <td class="px-6 py-4">
                            <ui>
                                {{$vac->name_job}}
                            </ui>

                        </td>
                        <td class="px-6 py-4">
                            <a href="{{Route('showConfirmPage',[$vac->vacancy_id])}}" class="font-medium text-blue-600 hover:underline">Открыть</a>
                        </td>
                        </tbody>
                @endforeach
            @endif
        </table>
    </div>
</div>
@include('footer')
</body>
</html>

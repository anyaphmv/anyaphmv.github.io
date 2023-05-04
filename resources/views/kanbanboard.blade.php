<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Канбан-доска</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .sortable.hover {
            background: lightblue;
        }
    </style>
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl">
    <div class="kanban flex my-4 w-full">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-sky-900 uppercase">
            <tr>
                @if($cols)
                    @foreach($cols as $col)
                        <th scope="col" class="px-3 py-3">
                            <div class="flex flex-row items-center">
                                {{$col->title}}
                                @if($col->id > 4)
                                    <button data-modal-target="edit-{{$col->title}}" data-modal-toggle="edit-{{$col->title}}"><img class="w-5 ml-1" src="{{asset('icon/edit.png')}}"></button>
                                    <button data-modal-target="delete-{{$col->title}}" data-modal-toggle="delete-{{$col->title}}"><img class="w-5 ml-1" src="{{asset('icon/delete.png')}}"></button>
                                @endif
                                <div id="edit-{{$col->title}}" tabindex="-1" aria-hidden="true" class="normal-case fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                    <div class="relative w-full h-full max-w-2xl md:h-auto down">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                <h3 class="text-xl font-semibold text-gray-900">Отредактировать столбец
                                                    "{{$col->title}}"</h3>
                                                <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                        data-modal-hide="edit-{{$col->title}}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                              clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{Route('EditCol',[$col->id])}}" class="m-3">
                                                <input type="text" name="title"
                                                       class="font-normal p-3 w-full h-[35px] mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                                                <div class="flex items-center">
                                                    <button type="submit"
                                                            class="mb-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                        Готово
                                                    </button>
                                                </div>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="delete-{{$col->title}}" tabindex="-1" aria-hidden="true" class="normal-case fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                    <div class="relative w-full h-full max-w-xs md:h-auto down">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                <h3 class="text-xl font-semibold text-gray-900">Удалить столбец
                                                    "{{$col->title}}"</h3>
                                            </div>
                                            <div class="m-3">
                                                <div class="flex items-center">
                                                    <form method="post" action="{{Route('deleteCol',[$col->id])}}">
                                                        @csrf
                                                        <button class="mb-3 mr-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                            Да
                                                        </button>
                                                    </form>
                                                    <button type="button"
                                                            class="mb-3 text-white bg-red-400 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" data-modal-hide="delete-{{$col->title}}">
                                                        Нет
                                                    </button>
                                                </div>
                                                @csrf
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                    @endforeach
                @endif
                <th scope="col" class="px-6 py-3">
                    <button data-modal-target="NewCol" data-modal-toggle="NewCol" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center h-[30px] w-[30px]" type="button">
                        +
                    </button>
                    <div id="NewCol" tabindex="-1" aria-hidden="true" class="normal-case fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">Новый столбец</h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="NewCol">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </div>
                                <form method="POST" action="{{Route('NewCol')}}" class="m-3">
                                    <input type="text" name="title" class="font-normal p-3 w-full h-[35px] mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                                    <div class="flex items-center">
                                        <button type="submit" class="mb-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Добавить</button>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
            </thead>
            @if($vacancies)
                @foreach($vacancies as $vacancy)
                    <tbody>
                    <tr class="border-b border-sky-900 border-opacity-40">
                        <td colspan="{{$countCol}}" class="text-center text-blue-600 font-semibold text-base">{{$vacancy->name_job}}</td>
                    </tr>
                    <tr class="border-b border-sky-900 border-opacity-40">
                        @foreach($cols as $col)
                            <td class="sortable px-2 py-2 hover:cursor-pointer" data-block="{{$col->id}}" id="{{$vacancy->vacancy_id}}">
                                    @foreach($resumes as $resume)
                                        @if($resume->colom_id == $col->id and $resume->id_vac == $vacancy->vacancy_id)
                                            <div class="block" id="{{$resume->resume_id}}">
                                                    <form method="post" action="{{Route('FormRecords',[$resume->resume_id,$vacancy->vacancy_id])}}">
                                                        @csrf
                                                        <div class="flex flex-row border border-1 border-blue-600 p-2 mb-2 w-[210px]">
                                                            <div class="text-sky-900 flex flex-col">
                                                                <div class="mb-1">{{$resume->FIO}} ({{$resume->Staff}})
                                                                </div>
                                                                <a href="{{Route('thisResume',[$resume->resume_id])}}"
                                                                   class="mb-1 underline text-gray-400 hover:no-underline hover:text-sky-900">подробнее</a>
                                                                @if($col->id == 2)
                                                                    <button type="button"
                                                                            data-modal-target="comment-{{$resume->resume_id}}"
                                                                            data-modal-toggle="comment-{{$resume->resume_id}}"
                                                                            class="flex hover:cursor-pointer text-white bg-blue-700 hover:bg-blue-800 rounded justify-center">
                                                                        Комментарий заказчика
                                                                    </button>
                                                                    <div id="comment-{{$resume->resume_id}}"
                                                                         tabindex="-1"
                                                                         aria-hidden="true"
                                                                         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                                        <div
                                                                            class="relative w-full h-full max-w-2xl md:h-auto">
                                                                            <div
                                                                                class="relative bg-white rounded-lg shadow">
                                                                                <div
                                                                                    class="flex items-start justify-between p-4 border-b rounded-t">
                                                                                    <h3 class="text-xl font-semibold text-gray-900">
                                                                                        Комментарий заказчика
                                                                                    </h3>
                                                                                    <button type="button"
                                                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                                                            data-modal-hide="comment-{{$resume->resume_id}}">
                                                                                        <svg aria-hidden="true"
                                                                                             class="w-5 h-5"
                                                                                             fill="currentColor"
                                                                                             viewBox="0 0 20 20"
                                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd"
                                                                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                                                  clip-rule="evenodd"></path>
                                                                                        </svg>
                                                                                        <span
                                                                                            class="sr-only">Close modal</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="p-4 space-y-6">
                                                                                    <p class="text-base leading-relaxed text-gray-500">
                                                                                        {{$resume->comment}}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            @if($col->id > 4)
                                                                <div class="flex flex-col justify-center ml-1">
                                                                    <input type="submit" name="delete" value="Удалить"
                                                                           class="hover:cursor-pointer text-white bg-blue-700 hover:bg-blue-800 rounded mb-1 p-1">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </form>
                                                    <script>
                                                        var url = "{{route('movingRecord', [':id', ':colom_id', ':id_vac'])}}";
                                                    </script>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($col->id > 4)
                                        <button type="button" data-modal-target="addIN-{{$col->id}}-{{$vacancy->vacancy_id}}" data-modal-toggle="addIN-{{$col->id}}-{{$vacancy->vacancy_id}}" class=" text-white bg-blue-700 hover:bg-blue-800 rounded p-1">Добавить</button>
                                    @endif
                                    <div id="addIN-{{$col->id}}-{{$vacancy->vacancy_id}}" tabindex="-1" aria-hidden="true" class="normal-case fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative w-full h-full max-w-2xl md:h-auto down">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                        <h3 class="text-xl font-semibold text-gray-900">Добавить резюме</h3>
                                                        <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="addIN-{{$col->id}}-{{$vacancy->vacancy_id}}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                      clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                <form method="Post" action="{{Route('AddNewRecord',[$col->id,$vacancy->vacancy_id])}}">
                                                    <select class="m-3 h-[30px] border rounded-lg border-gray-300" name="id">
                                                        @foreach($resumes as $resume)
                                                            @if($resume->colom_id !=4)
                                                                <option value="{{$resume->resume_id}}">{{$resume->FIO}}
                                                                    ({{$resume->Staff}})
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <div class="flex items-center">
                                                        <button type="submit"
                                                                class="m-3 mt-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                            Готово
                                                        </button>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        @endforeach
                    </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
    </div>
</div>
@include('footer')
</body>
</html>

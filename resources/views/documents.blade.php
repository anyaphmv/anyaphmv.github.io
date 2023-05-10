<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Документы</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl my-8">
    <div class="mt-8 mb-4 text-xl font-semibold tracking-tight text-blue-600 md:text-4xl">Документы</div>
    @if($docs)
        @foreach($docs as $doc)
            @foreach($doc as $documents)
                <div class="flex flex-col sm:flex-row justify-between sm:items-center border border-blue-600 h-[170px] sm:h-[50px] p-4 mb-2">
                <div class="w-[400px]">{{$documents->resum->FIO}} ({{$documents->resum->Staff}})</div>
                <div class="w-[100px]">{{$documents->date}}</div>
                <div>
                    @if($documents->name_id == 1)
                        <a href="{{Route('pdfExportAct',[$documents->id])}}"
                            class="justify-center min-w-[270px] sm:w-[300px] inline-flex items-center px-2 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Скачать акт о выполненных работах (PDF)
                        </a>
                    @endif
                    @if($documents->name_id == 2)
                        <a href="{{Route('pdfExportBill',[$documents->id])}}"
                            class="justify-center min-w-[270px] sm:w-[300px] inline-flex items-center px-1 py-1 sm:px-3 sm:py-2 sm:text-sm text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Скачать счет (PDF)
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        @endforeach
    @endif
</div>
@include('footer')
</body>
</html>

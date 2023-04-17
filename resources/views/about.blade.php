<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>О компании Rendement</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
@include('header')
<div class="mx-2 xl:mx-auto max-w-screen-xl my-8">
    <h1 class="mb-4 text-2xl font-bold tracking-tight text-blue-600 md:text-4xl">О компании</h1>
    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Быстро
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                    Надежно
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                    Выгодно
                </button>
            </li>
        </ul>
    </div>
    <div id="myTabContent" class="text-md">
        <div class="hidden p-4 rounded-lg bg-gray-50" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <p class="text-sky-900">Кандидаты уже находятся на месторождениях, значит, вам не придется тратить время и деньги на оформление пропусков, заниматься перебазировкой техники с места на место, искать попутный транспорт.</p>
            <p class="text-sky-900">1. Вы найдете исполнителя для выполнения задания в кратчайшие сроки.</p>
            <p class="text-sky-900">2. Вы получаете квалифицированного исполнителя и технику, которые ждут задания в нужном вам месте.</p>
            <p class="text-sky-900">3. Исполнители готовы приступить к работе в день получения заказа.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50" id="dashboard" role="tabpanel"
             aria-labelledby="dashboard-tab">
            <p class="text-sky-900">Пользуйтесь только достоверной информацией.</p>
            <p class="text-sky-900">1. Все личные данные, указанные в профилях исполнителей и заказчиков, проверяются.</p>
            <p class="text-sky-900">2. Все денежные операции, ведущиеся на сайте, защищены.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50" id="settings" role="tabpanel"
             aria-labelledby="settings-tab">
            <p class="text-sky-900">Заказчику не придется тратить время на просмотр сайтов с предложениями услуг и звонки кандидатам, а потом платить за плохую работу.</p>
            <p class="text-sky-900">1. Исполнитель не тратит время на поиск работы и продвижение себя.</p>
            <p class="text-sky-900">2. Мы взимаем плату только по итогу качественного исполнения заказа.</p>
            <p class="text-sky-900">3. Вы зарабатываете на собственном профессионализме!</p>
        </div>
    </div>
</div>
<section class="aboutUs bg-[url('/public/image/background.jpg')]">
    <div class="flex flex-col mx-2 md:items-center xl:items-start lg:mx-auto max-w-screen-xl z-10 py-10 lg:py-20">
        <h1 class="max-w-[800px] mb-4 text-lg font-bold tracking-tight text-sky-900 md:text-xl">Отработав более 15 лет в качестве подрядчика по обустройству нефтяных, газовых и нефтегазоконденсатных месторождений в ЯНАО и ХМАО, наша команда приобрела большой опыт в организации производства работ в данной сфере.</h1>
        <p class="max-w-[800px] mb-8 text-lg font-medium text-sky-900 lg:text-xl">Нами был накоплен опыт работы по взаимодействию с другими подрядными организациями, работающими на месторождениях.</p>
        <p class="max-w-[800px] text-lg font-medium text-sky-900 lg:text-xl">Результатом систематизации знаний и анализа проблем, возникающих при обустройстве или разработке месторождений, стало создание портала услуг - Rendement. Цель которого помочь оперативно решать возникающие проблемы по поиску организаций, предоставляющих сервисные услуги внутри месторождений, помочь с поиском исполнителей для ваших задач.</p>
    </div>
</section>
@include('footer')
</body>
</html>

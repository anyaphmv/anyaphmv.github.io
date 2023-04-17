<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rendement</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="antialiased">
    <div class="banner max-h-screen overflow-hidden">
        @include('header')
        @if($errors->any())
            <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <span class="font-medium">{{$errors->first()}}</span></div>
        @endif
        <section class="bg-center bg-[url('/public/image/slide1.jpg')]">
            <div class="z-10 px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-white md:text-5xl lg:text-6xl">Rendement - портал по подбору персонала</h1>
                <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Ускоряем процессы, экономим бюджет</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    <a href="{{Route('showPageAddVacancy')}}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-sky-900 rounded-lg bg-blue-300 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Создать вакансию
                        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="{{Route('vacancyPage')}}" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Список вакансий
                    </a>
                </div>
            </div>
        </section>
    </div>
    <div class="mx-2 xl:mx-auto max-w-screen-xl">
        <div class="advantages flex flex-col items-center my-8">
            <span class="text-3xl text-blue-600 font-bold">Наши преимущества</span>
            <div class="text-sky-900 my-3 flex items-center flex-wrap justify-center md:justify-between">
                <div class="flex mr-5 mb-2 font-normal w-[300px] h-36">
                    <div class="col m-auto">
                        <img class="w-20 m-auto" src="{{asset('icon/clock.png')}}">
                        <div>Оперативный подбор</div>
                    </div>
                </div>
                <div class="flex mr-5 mb-2 font-normal w-[300px] h-36">
                    <div class="col m-auto">
                        <img class="w-20 m-auto" src="{{asset('icon/dollar.png')}}">
                        <div>Экономия денег</div>
                    </div>
                </div>
                <div class="flex mr-5 mb-2 font-normal w-[300px] h-36">
                    <div class="col m-auto">
                        <img class="w-20 m-auto" src="{{asset('icon/group.png')}}">
                        <div>Большая база исполнителей</div>
                    </div>
                </div>
                <div class="flex mr-5 mb-2 font-normal w-[300px] h-36">
                    <div class="col m-auto">
                        <img class="w-20 m-auto" src="{{asset('icon/fast-time.png')}}">
                        <div>Экономия времени</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="video my-8 mx-auto max-w-screen-xl">
            <iframe class="mx-auto md:w-[560px] md:h-[315px]" src="https://www.youtube.com/embed/SPGkfvKtmGc?controls=0"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>
        <div class="vacancy flex flex-col items-center vacancy my-8">
            <span class="text-blue-600 text-3xl font-bold">Сейчас ищут</span>
            <div class="flex flex-wrap justify-center my-3 px-2">
                @if ($vacancies)
                    @foreach($vacancies as $vacancy)
                        <div class="mb-2 mx-2 w-[300px] sm:w-[400px] h-[250px] p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <div class="flex flex-col justify-between h-[200px]">
                                <h5 class="text-2xl font-bold tracking-tight text-sky-900">{{$vacancy->name_job}}</h5>
                                <div>
                                    <p class="font-normal text-gray-900">Место работы: {{$vacancy->place}}</p>
                                    <p class="font-normal text-gray-900">Работодатель: {{$vacancy->getcompany->company}}</p>
                                </div>
                                <h4 class="font-bold text-sky-900">Зарплата: {{$vacancy->paycheck}} руб.</h4>
                                <a href="{{Route('showThisVacancy', [$vacancy->vacancy_id])}}"
                                   class="w-[150px] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Подробнее
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a href="{{Route('vacancyPage')}}"
               class="py-2.5 px-5 mb-2 text-sm font-medium text-blue-600 focus:outline-none bg-white rounded-lg border border-blue-600 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Все
                вакансии</a>
        </div>
        <div class="mini-banner mx-2 md:mx-auto flex flex-col items-center my-8">
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row sm:max-w-xl">
                <img class="object-cover rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                     src="{{asset('image/logo.jpg')}}" alt="">
                <div class="flex flex-col items-center md:items-start justify-between p-4 leading-normal">
                    <h5 class="text-center sm:text-start mb-2 text-2xl font-bold tracking-tight text-sky-900">Не можете найти
                        подходящих сотрудников?</h5>
                    <p class="text-center sm:text-start mb-3 font-normal text-gray-700">Тогда мы поможем Вам! Всего лишь нужно
                        опубликовать вкансию и подробно описать требования! И мы в ту же минуту приступим к поиску! Вам
                        нужно всего лишь нажать кнопку!</p>
                    <a href="{{Route('showPageAddVacancy')}}"
                       class="min-w-[250px] sm:w-[350px] inline-flex justify-center items-center py-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Создать вакансию
                        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="questions my-8 mx-2">
            <span class="text-blue-600 flex justify-center text-3xl font-bold">Ответы на частые вопросы</span>
            <div class="my-3 w-full lg:w-auto" id="accordion-color" data-accordion="collapse"
                 data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600">
                <h2 id="accordion-color-heading-1">
                    <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200"
                            data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                            aria-controls="accordion-color-body-1">
                        <span>Регистрация и авторизация</span>
                        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                    <div class="p-5 border border-b-0 border-gray-200 text-sky-900">
                        <p class="mb-2">Чтобы создать личный аккаунт на сайте RENDEMENT.RU, вам необходимо:</p>
                        <p>1. Нажать кнопку «Войти» в правом верхнем углу главной страницы.</p>
                        <p>2. Нажать «Зарегистрироваться».</p>
                        <p>3. Внести в поле «Почта» действующий электронный адрес почты и нажать кнопку «Отправить код».</p>
                        <p>4. Ввести полученный код в окошко и нажать «Подтвердить».</p>
                        <p>5. Заполнить карточку регистрации как можно подробнее. Чем полнее и достовернее информация, тем легче вам будет найти на сайте исполнителя.</p>
                    </div>
                </div>
                <h2 id="accordion-color-heading-2">
                    <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200"
                            data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                            aria-controls="accordion-color-body-2">
                        <span>Как найти хорошего исполнителя?</span>
                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
                    <div class="p-5 border border-b-0 border-gray-200 text-sky-900">
                        <p class="mb-2">Чтобы обезопасить себя от риска встретить
                            мошенника, отправляя заказ исполнителю, выполняйте несколько простых рекомендаций.</p>
                        <p class="mb-2">Изучите профиль исполнителя. Обратите внимание
                            на данные, указанные им в документах, рейтинг, который растет в зависимости от качества его
                            работы, отзывы остальных заказчиков, а также дату регистрации на сайте. Чем дольше
                            зарегистрирован исполнитель, тем меньше шансов на то, что он окажется мошенником. Проверьте
                            указанные им профиль в соцсетях, сайт, если есть, номер телефона. Если сомнений ничего не
                            вызывает, обращайтесь.</p>
                        <p class="mb-2">Не полагайтесь на обещания и устные заверения,
                            требуйте документального подтверждения квалификации и проверяйте всю данную вам информацию.
                            Проверка документов на сайте также проходит, но страховка никогда не бывает лишней.</p>
                        <p class="mb-2">Заключите с исполнителем договор. Если
                            выполнение задания связано с передачей исполнителю материальных ценностей, рекомендуем
                            получить у него паспортные данные, и сохранить их до завершения работы.</p>
                        <p class="mb-2">Если заниматься оформлением документов вы не
                            готовы, запросите у исполнителя паспортные данные с фотографией станиц с ФИО и пропиской.
                            При создании задания вы можете указать, что исполнитель должен взять с собой паспорт для
                            оформления документов. Если в ответ на просьбу показать документы, вы получили категоричный
                            отказ, задумайтесь, стоит ли начинать сотрудничество.</p>
                        <p class="mb-2">Отказывайтесь от сотрудничества, если на
                            задание приехал не тот человек, с которым вы общались, а исполнитель вас не предупредил.</p>
                        <p>И помните: мы не являемся работодателями наших
                            пользователей и не влияем на ваше решение начать сотрудничество. Исполнителей и заказчиков
                            вы выбираете самостоятельно. Но мы всегда готовы помочь в случае возникновения конфликтной
                            ситуации, хотя и делаем все возможное, чтобы предотвратить подобное.</p>
                    </div>
                </div>
                <h2 id="accordion-color-heading-3">
                    <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200"
                            data-accordion-target="#accordion-color-body-3" aria-expanded="false"
                            aria-controls="accordion-color-body-3">
                        <span>Как опубликовать вакансию?</span>
                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200 text-sky-900">
                        <p class="mb-2">Чтобы опубликовать задание, потребуется
                            выполнить несколько простых шагов:</p>
                        <p class="mb-2">1. Войдите в личный аккаунт.</p>
                        <p class="mb-2">2. На главной странице нажмите кнопку «Создать
                            вакансию».</p>
                        <p class="mb-2">3. Заполните форму-заявку. Подробно опишите
                            задачу, указав месторождение или город, где нужна услуга. Внесите даты исполнения задания,
                            ориентировочный бюджет и способы оплаты. Если имеются дополнительные требования к
                            исполнителю (наличие пропуска, системы отслеживания, квалификация, оборудование и т.д.)
                            укажите это в соответствующем окошке. Прикрепите к заданию графические файлы, если
                            необходимо. Помните, чем подробнее вы распишите задачу, тем быстрее найдется
                            квалифицированный исполнитель для ее выполнения.</p>
                        <p class="mb-2">4. Заполнив и проверив заявку, нажмите клавишу
                            «Опубликовать». Задание появится на площадке нашего сервиса в разделе «Задания» и все
                            желающие смогут тут же с ним ознакомиться. Возможно, нужный человек найдется через несколько
                            минут после публикации.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
    </body>
</html>

<nav class="bg-white border-gray-200">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
        <a href="{{Route('mainPage')}}" class="flex items-center">
            <img src="{{asset('image/logo.jpg')}}" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo"/>
            <span class="text-sky-900 self-center text-xl font-semibold whitespace-nowrap">Rendement</span>
        </a>
        <div class="flex items-center">
            <a href="tel:5541251234"
               class="mr-6 text-sm font-medium text-gray-500 hover:underline">+7
                (999) 412-12-34</a>
            <ul class="flex">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item pr-2 hover:underline text-sky-900">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item hover:underline text-sky-900">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-sky-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">{{ Auth::user()->name }} <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                            <div class="py-1 dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-sky-900 hover:bg-gray-100">{{ __('Выход') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<nav class="bg-gray-50">
        <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
            <div class="flex items-center">
                <ul class="flex flex-row flex-wrap mt-0 space-x-8 text-sm font-medium">
                    <li>
                        <a href="{{Route('mainPage')}}" class="text-gray-900 hover:underline"
                           aria-current="page">Главная</a>
                    </li>
                    <li>
                        <a href="{{Route('vacancyPage')}}" class="text-gray-900 hover:underline">Вакансии</a>
                    </li>
                    <li>
                        <a href="{{Route('aboutPage')}}" class="text-gray-900 hover:underline">О нас</a>
                    </li>
                    @auth
                        @if(Auth::user()->user_role == 1)
                            <li>
                                <a href="{{Route('showPageMyVacancy', Auth::user()->id)}}" class="text-gray-900 hover:underline">Мои вакансии</a>
                            </li>
                            <li>
                                <a href="{{Route('showPageAddVacancy', Auth::user()->id)}}" class="text-gray-900 hover:underline">Создать
                                    вакансию</a>
                            </li>
                            <li>
                                <a href="{{Route('showMessagePage', Auth::user()->id)}}" class="text-gray-900 hover:underline">Подобранные резюме</a>
                            </li>
                            <li>
                                <a href="{{Route('showDocumentsPage')}}" class="text-gray-900 hover:underline">Документы</a>
                            </li>
                        @elseif(Auth::user()->user_role == 3)
                            <li>
                                <a href="{{Route('showPageModerate')}}" class="text-gray-900 hover:underline">Проверить вакансии</a>
                            </li>
                        @elseif(Auth::user()->user_role == 4)
                            <li>
                                <a href="{{Route('showAllResume')}}" class="text-gray-900 hover:underline">Все резюме</a>
                            </li>
                            <li>
                                <a href="{{Route('showADDResume')}}" class="text-gray-900 hover:underline">Добавить резюме</a>
                            </li>
                            <li>
                                <a href="{{Route('showKanban')}}" class="text-gray-900 hover:underline">Канбан-доска</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

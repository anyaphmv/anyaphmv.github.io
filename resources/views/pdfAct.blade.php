<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Акт о выполненных работах</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        table{
            border-collapse: collapse;
            margin-top: 6px;
            width: 100%;
            border: 1px solid #000;
        }
        td{
            border: 1px solid #000;
            font-weight: normal;
        }
        th{
            border: 1px solid #000;
            font-weight: bold;
        }
        div.itogo{
            float: right;
        }
        p{
            margin-top: 70px;
            color: dimgrey;
        }
        div.line{
            border-top: 3px solid black;
            margin-bottom: 20px;
        }
        div.line2{
            border-top: 1px solid black;
            margin-top: 80px;
        }
        div.line3{
            border-top: 1px solid black;
            margin-top: 60px;
        }
    </style>
</head>
<body style="font-family: DejaVu Sans, sans-serif;">
    <div style="font-weight: bold; font-size: 25px;">Акт о выполненных работах от {{ \Carbon\Carbon::parse($docs->date)->format('d.m.Y')}}</div>
    <div><span style="font-weight: bold;">Исполнитель: </span>OOO "Rendement", ИНН 701827491037319, в банке ПАО СБЕРБАНК</div>
    <div><span style="font-weight: bold;">Заказчик: </span>{{Auth::user()->company}}, {{Auth::user()->name}}</div>
    <table>
        <thead>
        <tr>
            <th>№</th>
            <th>Наименование работ, услуг</th>
            <th>Кол-во</th>
            <th>Ед.</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Подбор персонала: {{$docs->resum->FIO}} по профессии "{{$docs->resum->Staff}}" на вакансию "{{$vac->name_job}}"</td>
            <td>1</td>
            <td>шт</td>
            <td>5000</td>
            <td>5000</td>
        </tr>
        </tbody>
    </table>
    <div class="itogo">
        <div>ИТОГО: 5000</div>
        <div>В том числе НДС: 1000</div>
    </div>
    <p>Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и срокам оказания услуг не имеет</p>
    <div class="line"></div>
    <div style="float: left; font-weight: bold; font-size: 18px; width: 200px;">Заказчик<div class="line2"></div></div>
    <div style="float: right; margin-right: 200px; font-weight: bold; font-size: 18px;">Исполнитель<div style="font-weight: normal; font-size: 12px; color: dimgray">Гениральный директор Rendement</div><div class="line3"></div></div>
</body>
</html>

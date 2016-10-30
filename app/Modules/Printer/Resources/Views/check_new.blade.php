<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Печать чека</title>
    {!! Html::style( asset("assets/components/reset.css")) !!}
    {!! Html::style( asset('assets/semantic.css')) !!}
    {!! Html::style( asset('assets/buch.print.css')) !!}
</head>
<body>
<div class="ui container">

</div>


<table id="sales_receipt">
    <!-- Поставщик -->
    <tr class="bold">
        <td class="provider">
            <dl>
                <dt>Поставщик:</dt>
                <dd class="b_b">ИП AIZHAR DESIGN STUDIO</dd>
            </dl>
            <dl>
                <dt>Адрес:</dt>
                <dd>г.Актау 12-55-1</dd>
            </dl>
        </td>
    </tr>


    <!-- Образец платежного поручения -->
    <tr style="height: 22px;">
        <td class="ob_plt_por bold">Образец платежного поручения</td>
    </tr>

    <tr>
        <td>
            <table>
                <tr class="bold">
                    <td colspan="2">Бенефициар: ИП AIZHAR DESIGN STUDIO<br>БИН(ИИН): 900901302131</td>
                    <td colspan="1" class="text_center">ИИК<br>KZ91914082204KZ0188L</td>
                    <td colspan="1" class="text_center">Кбе<br>19</td>
                </tr>
                <tr>
                    <td colspan="2">Банк бенефициара: <br>ДБ АО Сбербанк России г. Актау</td>
                    <td colspan="1" class="text_center">БИК<br>SABRKZKA</td>
                    <td colspan="1" class="text_center">Код назначения платежа<br>099</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="payer">
        <td>ПЛАТЕЛЬЩИК: ИП Васильев А.С.</td>
    </tr>
    <tr>
        <td>
            Номер документа
            Дата составления
        </td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>

</table>

    <table>
        <tr>
            <td>Номер документа</td>
            <td>Дата составления</td>
        </tr>
        <tr>
            <td>Счет</td>
            <td>1</td>
            <td>Чт 14.07.16</td>
        </tr>
        <tr>
            <td>Основание: Договор №21-01/16 от 01.01.2015</td>
        </tr>
        <tr>
            <td>№</td>
            <td>Наименование</td>
            <td>Кол-во</td>
            <td>Ед.изм.</td>
            <td>Цена</td>
            <td>Сумма</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Супер отвертка производство США</td>
            <td>10</td>
            <td>шт</td>
            <td>8000,00</td>
            <td>89600,00</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Супер отвертка производство США</td>
            <td>10</td>
            <td>шт</td>
            <td>8000,00</td>
            <td>89600,00</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Уборка территории</td>
            <td>500</td>
            <td>кв. м.</td>
            <td>1500,00</td>
            <td>840000,00</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Вывоз мусора</td>
            <td>1000</td>
            <td>кг.</td>
            <td>1000,00</td>
            <td>1120000,00</td>
        </tr>
        <tr>
            <td>Итого:</td>
            <td>2139200,00</td>
        </tr>

        <tr>
            <td>Без НДС</td>
        </tr>
        <tr>
            <td>&nbsp;sgdgsdgsdg</td>
        </tr>

        <tr>
            <td>Всего наименований 4, на сумму</td>
            <td>2139200,00</td>
        </tr>
        <tr>
            <td>Сумма прописью: Два миллиона сто тридцать девять тысяч двести тенге 00 тиын</td>
        </tr>
        <tr>
            <td>Руководитель:</td>
            <td>&nbsp;jgfj</td>
        </tr>
    </table>
</body>
</html>


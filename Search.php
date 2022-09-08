<?
    // Инициализация SOAP-клиента

$client = new SoapClient('https://api.forum-auto.ru/wsdl', ["exceptions" => false]);

// Выполнение запроса к серверу API Форум-Авто

//Входные параметры
$login = '493358_stroyzar';
$pass = 'sAVDkrEbqd';
$json = $_POST['myData'];
$art = json_decode($json);  
$cross; // Кроссы товара - необязательное поле
$br;    // Название бренда - необязательное поле
$gid;   // ID товара в системе - необязательное поле

$result = $client->listGoods($login, $pass, $art, $cross, $br, $gid);

if (is_soap_fault($result)) {

    // Обработка ошибки

    echo "SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring}, detail: {$result->detail})";

} else {

    // Результат запроса

    //На выходе будет многомерный массив!

    $array = $result;

    echo('<table border="1">');
            echo('<tr><td>ID Товара</td><td>Брэнд</td><td>Артикул</td><td>Наименование</td>
            <td>Кол-во дней доставки</td><td>Кол-во часов доставки</td><td>Кратность товара</td>
            <td>Доступное кол-во товара</td><td>Цена</td><td>Склад</td><td>Возм возврата</td></tr>');
            for ($i = 0 ; $i < count(($array)); ++$i) {
                $info = $array[$i];
                echo ('<tr>');
                foreach($info as $key => $value) {
 
                        echo ('<td>' . $value . '</td>');
                    
                    
                }
                echo ('</tr>');
            }
    echo('</table>');

}
?>
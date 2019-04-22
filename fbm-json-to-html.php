<?php
$param = [];
if (!empty($argv))
    foreach ($argv AS $v)
    {
        $p = explode('=', $v);
        $param[$p[0]] = isset($p[1]) ? $p[1] : false;
    }
if (!isset($param['messages'])) die("Provide input file\n");
if (!file_exists($param['messages'])) die("File not found\n");
$messages = json_decode(file_get_contents($param['messages']));
?>
<!doctype html>
    <head>
        <title>FB Message history</title>
        <meta charset="utf-8" />
        <style>
        table { border-collapse: collapse; text-align: left; width: 100%; } table td, table th { padding: 3px 10px; }table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #991821), color-stop(1, #80141C) );background:-moz-linear-gradient( center top, #991821 5%, #80141C 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#991821', endColorstr='#80141C');background-color:#991821; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #B01C26; } table thead th:first-child { border: none; }table tbody td { color: #80141C; border-left: 1px solid #F7CDCD;font-size: 12px;font-weight: normal; }table tbody .alt td { background: #F7CDCD; color: #80141C; }table tbody td:first-child { border-left: none; }table tbody tr:last-child td { border-bottom: none; }
        </style>
    </head>
    <body>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 140px">Date</th>
                    <th style="width: 200px">From</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
<?php
    foreach ($messages->messages AS $message) :
        echo "<tr><td>".date('Y-m-d H:i:s', $message->timestamp_ms/1000)."</td><td>".utf8_decode($message->sender_name)."</td>";
        echo "<td>".(isset($message->content) ? utf8_decode(mb_convert_encoding($message->content, 'auto', 'iso-8859-1')) : '')."</td></tr>\r\n";
    endforeach;
?>
            </tbody>
        </table>
    </body>
</html>

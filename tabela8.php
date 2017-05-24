<!DOCTYPE html>
<html>
<head>
    <title>Tabela</title>
</head>
<body>

<?php

$tabela = array(
    array(
        'ime' => 'Milan',
        'godine' => 34,
        'godiste' => 1983
    ),
    array(
        'ime' => 'luko',
        'godine' => 32,
        'godiste' => 1985
    ),
    array(
        'ime' => 'Sandra',
        'godine' => 30,
        'godiste' => 1987
    ),
    array(
        'ime' => 'Beka',
        'godine' =>  29,
        'godiste' => 1988
    ),
    array(
        'ime' => 'Luka',
        'godine' =>  24,
        'godiste' => 1993
    ),
);

echo '<table  border="5" cellpadding="10">';
echo '<tr>';
echo '<th>Ime</th>';
echo '<th>Godine</th>';
echo '<th>Godiste</th>';
echo '<th>T_Godina</th>';
echo '<th>Prosek</th>';
echo '</tr>';

// jedan nachin za sumu i prosek :
$t_godina = 0;
$suma = 0;
$prosek = 0;
for ($i = 0; $i < 5; $i++) {
    $suma = $suma + $tabela[$i]['godine'];
    $prosek = $prosek + $tabela[$i]['godiste'];
    echo '<tr>';
    echo '<td>' . $tabela[$i]['ime'] . '</td>';
    echo '<td>' . $tabela[$i]['godine'] . '</td>';
    echo '<td>' . $tabela[$i]['godiste'] . '</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '</tr>';
}
// sada imamo vrednosti za sumu, i moramo da izrachunamo prosek
$prosek = $prosek / 4;  // 4 chlana
?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><?php echo $suma; ?></td>
    <td><?php echo $prosek; ?></td>
</tr>
</table>
</body>
</html>
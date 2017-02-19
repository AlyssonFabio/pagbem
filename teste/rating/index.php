<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.rating.js"></script>
<script type="text/javascript">
jQuery(function(){
    jQuery('form.rating').rating();
});
</script>
<title>Index</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

<?
mysql_connect('host','user','senha');
mysql_select_db('banco_de_dados');

$SQL = " SELECT votos, pontos FROM registro WHERE id = 1";
$RS = mysql_query($SQL);
$RF = mysql_fetch_array($RS);

$r = number_format($RF['pontos'] / $RF['votos'],2,'.','.');
?>

Aqui aparecerão as estrelas:
<form style="display:none" title="Average Rating: <?=$r?>" class="rating" action="rate.php">
    <input type="hidden" name="valor" value="1" />
    <select id="r1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
</form>

</body>
</html>

<?php
use LazForm\Form;
use LazForm\Type\FieldType\Type;

error_reporting(1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
?>
<!DOCTYPE HTML>
<html lang="en_GB">
<head>
    <meta charset="utf-8"/>
    <title>App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<h1>Hello!</h1>
<?php
try {
//    echo Form::Input()->type(Type::CHECKBOX)
//        ->attributes(['id' => 'street', 'name' => 'street_star', 'placeholder' => "Enter street name"])
//        ->label('Find the nearest station')
//        ->options([
//                1, 2, 3,4, 5
//        ]);
//    echo Form::Input()->type(Type::CHECKBOX)
//        ->attributes(['id' => 'street', 'name' => 'street_star', 'placeholder' => "Enter street name"])
//        ->label('Find the nearest station');
    echo Form::Input()->type(Type::DATE)
        ->attribute('id', 'street')
        ->attribute('name', "name")
        ->attribute('placeholder', 'Enter street name')
        ->label('Find the nearest station')
        ->labelDetails("<br><span>Minimum characters of 12 length</span>");
} catch (\Exception $e) {
}
?>
</body>
</html>
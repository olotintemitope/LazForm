<?php
use LazForm\Form;
use LazForm\Type\FieldType\Type;

require_once '../vendor/autoload.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <title>App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<h1>Hello!</h1>
<?php
try {
    echo Form::Input()->type(Type::EMAIL)
        ->value("Ipaja")
        ->attributes(['id' => 'street', 'name' => 'street_star', 'placeholder' => "<script>alert('hi')</script>"])
        ->label('Find the nearest station')
        ->labelDetails("<span>Please limit your response to 255 characters.</span>")
        ->readonly(true)
        ->disabled(true);
} catch (\Exception $e) {
}
?>
</body>
</html>
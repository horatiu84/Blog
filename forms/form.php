<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="process_form.php" method="post">
        <label for="name">Name:</label>
        <input id="name" type="text" name="name">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password">

        <label for="marque">Choose the marque:</label>
        <select name="marque" id="marque">
            <option value="bmw">BMW</option>
            <option value="fmc">FORD</option>
            <option value="saab">Saab</option>
        </select>
        <button>Send</button>
    </form>
    
</body>
</html>
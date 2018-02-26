<!doctype html>
<html>
<head>
    <title>Upload Items</title>
</head>
<body>
<form action="application/includes/register.php" enctype="multipart/form-data" method="post">

    <input type="file" name="photo" required/>

    <br/>
    <br/>

    <input type="number" name="employee_number" placeholder="Enter your Employee Number" required size="25"/>
    <br/>
    <br/>

    <input type="text" name="tax_pin" placeholder="Enter your tax PIN" required size="25"/>
    <br/>
    <br/>

    <input type="date" name="date_hired" placeholder="Enter the Date Hired" required size="25"/>
    <br/>
    <br/>

    <input type="number" name="id_number" placeholder="Enter your ID Number" required size="25"/>
    <br/>
    <br/>

    <input type="number" name="verifier_number" placeholder="Enter verifier Number" required size="25"/>
    <br/>
    <br/>

    <input type="submit" name="submit" value="submit">
</form>
</body>
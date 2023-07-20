<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphic</title>
</head>
<body>
    <?php include 'nav.php'; ?>
    <form method="POST" action="">
        <input type="text" name="Month" id="Month" placeholder="Insert Month">
        <input type="number" name="Data" id="Data" placeholder="Insert Data">
        <button type="submit">Submit Data</button>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli('localhost', 'root', '', 'Graphic');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['Month'])) {
            $Month = $_POST['Month'];
        } else {
            $Month = ''; 
        }

        if (isset($_POST['Data'])) {
            $data = $_POST['Data'];
        } else {
            $data = '';
        }

        $st = $conn->prepare("INSERT INTO data (Month, Data) VALUES (?, ?)");
        $st->bind_param("ss", $Month, $data);
        $st->execute();

        $st->close();
        $conn->close();

    }
    ?>
</body>
</html>
<style scoped>
    form {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    input {
        border: none;
        border-bottom: 1px black solid;
        margin: 20px;
        padding: 12px 5px;
    }
</style>

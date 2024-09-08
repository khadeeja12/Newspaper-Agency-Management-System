<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Newspapers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Base styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 600px;
        }
        h2 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        select,
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            width: 100%;
        }
        button {
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }

        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Assign Newspapers to Paperboys</h2>
    <form action="" method="post">
        <select name="paperboy_id" required>
            <option value="" disabled selected>Select Paperboy</option>
            <?php
                $con = mysqli_connect("localhost", "root", "", "newspaper");

                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                $paperboy_query = "SELECT * FROM paperboys";
                $paperboy_result = mysqli_query($con, $paperboy_query);

                if ($paperboy_result && mysqli_num_rows($paperboy_result) > 0) {
                    while ($paperboy_row = mysqli_fetch_assoc($paperboy_result)) {
                        echo "<option value='" . $paperboy_row['id'] . "'>" . $paperboy_row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No paperboys found</option>";
                }

                mysqli_close($con);
            ?>
        </select>
        <select name="newspaper_id" required>
            <option value="" disabled selected>Select Newspaper</option>
            <?php
                $con = mysqli_connect("localhost", "root", "", "newspaper");

                $newspaper_query = "SELECT * FROM newspapers";
                $newspaper_result = mysqli_query($con, $newspaper_query);

                if ($newspaper_result && mysqli_num_rows($newspaper_result) > 0) {
                    while ($newspaper_row = mysqli_fetch_assoc($newspaper_result)) {
                        echo "<option value='" . $newspaper_row['id'] . "'>" . $newspaper_row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No newspapers found</option>";
                }

                mysqli_close($con);
            ?>
        </select>
        <select name="region" required>
            <option value="" disabled selected>Select Region</option>
            <?php
                $con = mysqli_connect("localhost", "root", "", "newspaper");

                $region_query = "SELECT DISTINCT region FROM paperboys";
                $region_result = mysqli_query($con, $region_query);

                if ($region_result && mysqli_num_rows($region_result) > 0) {
                    while ($region_row = mysqli_fetch_assoc($region_result)) {
                        echo "<option value='" . $region_row['region'] . "'>" . $region_row['region'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No regions found</option>";
                }

                mysqli_close($con);
            ?>
        </select>
        <input type="number" name="num_newspapers" placeholder="Number of Newspapers" required>
        <button type="submit">Assign Newspapers</button>
    </form>
</div>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Resume</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f6f8;
            margin: 40px;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.08);
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }
        .header {
            grid-column: span 2;
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
            position: relative;
        }
        .header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 30px;
            margin: 0;
            color: #2c3e50;
            font-weight: 700;
        }
        .header h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            color: #555;
            margin: 5px 0 0 0;
            font-weight: 500;
        }
        h4 {
            font-family: 'Poppins', sans-serif;
            margin-top: 20px;
            padding-bottom: 5px;
            font-size: 18px;
            color: #2c3e50;
            border-bottom: 2px solid #eee;
            font-weight: 600;
        }
        p {
            margin: 8px 0 15px 0;
            line-height: 1.6;
            font-size: 15px;
        }
        ul {
            padding-left: 20px;
            margin: 10px 0;
            font-size: 15px;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .skill {
            background: #f0f2f5;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 14px;
            color: #333;
            font-family: 'Open Sans', sans-serif;
        }

        #printBtn {
            position: absolute;
            right: 20px;
            top: 20px;
            padding: 8px 14px;
            font-size: 14px;
            border: none;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        #printBtn:hover {
            background-color: #2980b9;
        }

        @media print {
            #printBtn {
                display: none;
            }
            body {
                background: #fff;
                margin: 0;
            }
            .container {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
    <script>
        function printResume() {
            window.print();
        }
    </script>
</head>
<body>
    <?php
        $fullname = "John Timothy Sta. Maria Carranza";
        $title = "Fullstack Developer";
        $address = "Betzaida Village, Dumantay, Batangas City";
        $email = "carranza.timothy12@gmail.com";
        $number = "09859122779";
        $github = "https://github.com/Carranza-John-Timothy";
        $skills = ["Java", "Python", "C", "HTML", "CSS", "JavaScript", "MySQL"];
    ?>

    <div class="container">
        <div class="header">
            <h2><?php echo $fullname; ?></h2>
            <h3><?php echo $title; ?></h3>
            <button id="printBtn" onclick="printResume()">Print Resume</button>
            <p>Welcome, <?php echo $_SESSION["username"]; ?>! <a href="logout.php">Logout</a></p>
        </div>

        <!-- Left Column -->
        <div>
            <h4>Personal Information</h4>
            <p>Address: <?php echo $address; ?></p>

            <h4>Contacts</h4>
            <p>
                Email: <?php echo $email; ?><br>
                Number: <?php echo $number; ?><br>
                GitHub: <a href="<?php echo $github; ?>" target="_blank"><?php echo $github; ?></a>
            </p>

            <h4>Skills & Tech</h4>
            <div class="skills-container">
                <?php foreach ($skills as $skill) { echo "<div class='skill'>$skill</div>"; } ?>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <h4>Objective</h4>
            <p>Aspiring Fullstack Developer with strong foundations in web development and programming. Passionate about building scalable applications and eager to learn modern technologies.</p>

            <h4>Education</h4>
            <p>
                <b>Bachelor of Science in Computer Science</b><br>
                Batangas State University TNEU - Alangilan Campus | 2023 - Present<br><br>
                <b>Senior Highschool</b><br>
                Batangas State University Integrated School - Pablo Borbon Main | 2021 - 2023
            </p>

            <h4>Achievements</h4>
            <ul>
                <li>Dean's Lister 2023</li>
                <li>Dean's Lister 2024</li>
            </ul>
        </div>
    </div>
</body>
</html>

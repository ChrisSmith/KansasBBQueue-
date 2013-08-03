<html>
<body>

Welcome <?php echo $_POST["fname"]; echo " " . $_POST["lname"]; ?>!<br>
You are <?php echo $_POST["street"]; ?> years old.<br>
You live at <?php echo $_POST["street-num"] . " " . $_POST["street"]; ?> in <?php echo $_POST["state"] ?>.<br>
Notify by <?php echo $_POST["notify"]; ?>


</body>
</html>
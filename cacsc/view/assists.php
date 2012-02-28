<html>
    <head></head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Player</th><th>Assists</th><th>Team</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($topassists as $topassist) {
                    echo "<tr><td>" . $topassist['user'] . "</td><td>" . $topassist['assists'] . "</td><td>". $topassist['team'] . "</td><td><img src='uploads/profiles/" . $topassist['user'] . ".jpg' width=100 height=100></td><tr>";
                }
                ?>

            </tbody>
        </table>
    </body>

</html>
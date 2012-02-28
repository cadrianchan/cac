<html>
    <head></head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Team Name</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($teamnames as $teamname) {
                    echo "<tr><td>" . $teamname . "</td><tr>";
                }
                ?>

            </tbody>
        </table>
    </body>

</html>
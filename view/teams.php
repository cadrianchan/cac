<div class="content">
    <table class='statstable'>
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
<!-- end .content --></div>
<div class="content">
    <table class='statstable'>
        <thead>
            <tr>
                <th>Top Scorer</th><th>Goals</th><th>Team</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($topscorers as $topscorer) {
                echo "<tr><td>" . $topscorer['user'] . "</td><td>" . $topscorer['goals'] . "</td><td>" . $topscorer['team'] . "</td><td><img src='uploads/profiles/" . $topscorer['user'] . ".jpg' /></td><tr>";
            }
            ?>

        </tbody>
    </table>
<!-- end .content --></div>
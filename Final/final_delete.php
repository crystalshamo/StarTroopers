<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Delete Job Openings page</title>
  </head>
  <body>
    <p>Delete Job Openings<p>
   <form action="handle_deletion.php" method="post">
      <table border = "1">
            <tr>
                <th>Select</th>
                <th>Opening ID</th>
                <th>Company ID</th>
                <th>Qualification Code</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Pay Hourly</th>
            </tr>
            <?php include 'final_display_delete.php'; ?>
        </table>
        <input type="submit" value="Delete Selected">
    </form>
  </body>
</html>
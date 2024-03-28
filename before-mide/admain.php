<?php
    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "testt");
 
    // get all inbox messages such that latest messages are on top
    $sql = "SELECT * FROM inbox ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
 
?>
 
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
    </style>
 
    <table class="table">
 
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
 
<?php while ($row = mysqli_fetch_object($result)): ?>
        <tr style="<?php $row->is_read ? '' : 'background-color: lightgray;'; ?>">
            <td><?php echo $row->name; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->message; ?></td>
            <td>
                <?php if (!$row->is_read): ?>
                    <form method="POST" action="mark-as-read.php" onsubmit="return confirm('Are you sure you want to mark it as read ?');">
                        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                        <input type="submit" value="Mark as read">
                    </form>
                <?php endif; ?>
 
                <form method="POST" action="delete-inbox-message.php" onsubmit="return confirm('Are you sure you want to delete this ?');">
                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
<?php endwhile; ?>
 
                </table>
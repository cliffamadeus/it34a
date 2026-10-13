<?php
require '../../config/config.php';

requireRole('admin');

/*
logActivity(
    $pdo,
    $_SESSION['user_id'],
    $_SESSION['user_email'],
    'view_activity_logs',
    'success'
);
*/

$section = $_GET['section'] ?? 'activity-logs';

if($section==='activity-logs'){
    // Activity Logs Query#3
    $stmt = $pdo->query("
        SELECT *
        FROM activity_logs
        ORDER BY activity_log_created_at DESC
    ");

    $activities = $stmt->fetchAll();
}

if($section==='user-sessions'){
    
    // Activity Logs Query#3
    $stmt = $pdo->query("
        SELECT *
        FROM user_sessions
        ORDER BY session_end DESC
    ");

    $sessions = $stmt->fetchAll();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome Admin</h1>
    <a href="../../auth/signout.php">Sign Out</a>
  
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="index.php?section=activity-logs">Activity Logs |</a>
        <a href="index.php?section=user-sessions">User Sessions |</a>
    </nav>
    
    <?php if($section==='activity-logs'):?>
        <table class="table table-striped" style="width:auto" border="1px">
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>User ID</th>
                    <th>User Email</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th>IP Address</th>
                    <th>User Agent</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($activities as $activity):?>
                    <tr>
                        <td><?= htmlspecialchars($activity['activity_log_id'])?></td>
                        <td><?= htmlspecialchars($activity['user_id'])?></td>
                        <td><?= htmlspecialchars($activity['user_email'])?></td>
                        <td><?= htmlspecialchars($activity['activity_log_action'])?></td>
                        <td><?= htmlspecialchars($activity['activity_log_status'])?></td>
                        <td><?= htmlspecialchars($activity['activity_log_ip_address'])?></td>
                        <td><?= htmlspecialchars($activity['activity_log_user_agent'])?></td>
                        <td><?= htmlspecialchars($activity['activity_log_created_at'])?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif($section==='user-sessions'): ?>
        
        <table class="table table-striped" style="width:auto" border="1px">
            <thead>
                <tr>
                    <th>Session ID</th>
                    <th>User ID</th>
                    <th>Session Start</th>
                    <th>Session End</th>
                    <th>Session Duration</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sessions as $session):?>
                    <tr>
                        <td><?= htmlspecialchars($session['session_id'])?></td>
                        <td><?= htmlspecialchars($session['user_id'])?></td>
                        <td><?= htmlspecialchars($session['session_start'])?></td>
                        <td><?= htmlspecialchars($session['session_end'])?></td>
                        <td><?= gmdate('H:i:s', (int)$session['session_duration'])?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif?>

</body>
</html>
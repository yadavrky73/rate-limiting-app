<!-- resources/views/session.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Management</title>
</head>
<body>
    <div>
        <h1>Session Management</h1>
        <p>Only one session per IP address is allowed.</p>
        <button id="continueSessionBtn">Continue Second Session</button>
    </div>

    <script>
        document.getElementById('continueSessionBtn').addEventListener('click', function() {
            fetch('/close-previous-session', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({})
            })
            .then(response => {  
                console.log('Previous session closed successfully');
              
                window.location.reload();
            })
            .catch(error => {
            
                console.error('Error closing previous session:', error);
            });
        });
    </script>
</body>
</html>

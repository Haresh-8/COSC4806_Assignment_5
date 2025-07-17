
<?php 
require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Hey, <?= $_SESSION['username'] ?? 'User'; ?>!</h1>
                <p class="text-success">You are now logged in.</p>
                
                <p class="lead" id="local-time">
                    <?= date("F jS, Y - h:i:s A") ?> <!-- This will show server time briefly before JS kicks in -->
                </p>

               
                <script>
                  function updateLocalTime() {
                    const now = new Date();
                    const formatted = now.toLocaleString(undefined, {
                      year: 'numeric',
                      month: 'long',
                      day: 'numeric',
                      hour: '2-digit',
                      minute: '2-digit',
                      second: '2-digit',
                      hour12: true
                    });

                    document.getElementById('local-time').textContent = "" + formatted;
                  }

                  setInterval(updateLocalTime, 1000);  // update every second
                  updateLocalTime();  // initial call
                </script>

                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a href="/logout" class="btn btn-primary mb-4 mt-4">Click here to logout</a>

        </div>
    </div>

    <?php require_once 'app/views/templates/footer.php' ?>


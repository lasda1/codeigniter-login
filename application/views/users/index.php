    <main role="main">
        <div class="container">
            <!-- Example row of columns -->
            <?php foreach ($users as $user) : ?>
                <h3><?php echo 'User name : '.$user['name']; ?></h3><br/>
                <p>  email : <?php echo $user['email']; ?></p>
            <?php endforeach; ?>

            <a style="float: right" class="btn btn-primary" href="<?php echo base_url()?>create" role="button">Add User</a>
        </div>
        <hr>

    </main>

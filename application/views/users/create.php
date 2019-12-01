<main role="main">
    <div class="container">
        <!-- Example row of columns -->
        <?php if ($emailError !== ''): ?>

            <div class="alert alert-danger" role="alert">
                This email is not Valid !!!
            </div>

        <?php elseif ($recaptchaError !== ''): ?>

            <div class="alert alert-danger" role="alert">
                please fill the recaptcha
            </div>

        <?php endif; ?>
        <div class="row">
            <?php echo validation_errors(); ?>
            <?php echo form_open('create'); ?>
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input name="name" type="text" class="form-control" id="name" required placeholder="fofo">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email"name="email" class="form-control" required id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">Write a valid email !!!.</small>
                </div>
                <div class="g-recaptcha" data-sitekey="6Ld0asUUAAAAAGvWDO7f85tnL9gNUXZvP-ma_wGv"></div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <hr>

</main>

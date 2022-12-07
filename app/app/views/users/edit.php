<div class="container text-center" id="container">
    <div class="box">
        <h3 class="display-4 text-center">Update</h3><br>
        <div class="row">

            <div class="col">
                <form method="post" id="update_form" action="/users/update">

                    <!-- Email unique -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>

                        <?php if (isset($errors) && isset($errors['email'])): ?>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= $_POST['email'] ?>" placeholder="name@example.com">
                            <div class="error">
                                <span class="errorMsg"><b><?= $errors['email'] ?></b></span>
                            </div>
                        <?php elseif (isset($_POST['email'])): ?>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= $_POST['email'] ?>" placeholder="name@example.com">
                        <?php elseif (isset($result['email'])): ?>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= $result['email'] ?>" placeholder="name@example.com">
                        <?php else: ?>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= $_POST['email'] ?>" placeholder="name@example.com">
                        <?php endif; ?>

                    </div>

                    <!-- First and last name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Your first and last name</label>
                        <?php if (isset($errors) && isset($errors['name'])): ?>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $_POST['name'] ?>">
                            <div class="error">
                                <span class="errorMsg"><b><?= $errors['name'] ?></b></span>
                            </div>
                        <?php elseif (isset($_POST['email'])): ?>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $_POST['name'] ?>">
                        <?php else: ?>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= $result['full_name'] ?>">
                        <?php endif; ?>
                    </div>

                    <!-- Gender dropdown -->
                    <label for="gender">Gender</label>
                    <select required name="gender" class="form-control" id="gender">
                    <?php if (isset($errors) && isset($errors['gender'])): ?>

                            <option value="" selected disabled hidden>-- Choose your gender --</option>
                            <option value="Male" <?php $gender = "" ?>;
                                    echo $gender==
                            "Male" ? "selected" : "" ?>Male</option>
                            <option value="Female" <?php echo $gender == "Female" ? "selected" : "" ?>>Female</option>
                        <div class="error">
                            <span class="errorMsg"><b><?= $errors['gender'] ?></b></span>
                        </div>
                    <?php elseif (isset($_POST['gender'])): ?>
                            <option value="Male" <?php if ($_POST['gender'] == "Male") echo "selected=\"selected\""; ?>>
                                Male
                            </option>
                            <option value="Female" <?php if ($_POST['gender'] == "Female") echo "selected=\"selected\""; ?>>
                                Female
                            </option>
                    <?php else: ?>
                            <option value="Male" <?php if ($result['gender'] == "Male") echo "selected=\"selected\""; ?>>
                                Male
                            </option>
                            <option value="Female" <?php if ($result['gender'] == "Female") echo "selected=\"selected\""; ?>>
                                Female
                            </option>
                    <?php endif; ?>
                    </select>

                    <!-- Status dropdown -->
                    <label>Status</label>
                    <select name="status" class="form-control" id="status">
                        <?php if (isset($errors) && isset($errors['status'])): ?>
                            <option value="" selected disabled hidden>-- Choose your status --</option>
                            <option value="Active" <?php $status = "" ?>
                                    echo $gender==
                            "Active" ? "selected" : "" ?>Active</option>
                            <option value="Inactive" <?php echo $status == "inactive" ? "selected" : "" ?>>Inactive
                            </option>
                            <div class="error">
                                <span class="errorMsg"><b><?= $errors['status'] ?></b></span>
                            </div>
                        <?php elseif (isset($_POST['status'])): ?>

                            <option value="Active" <?php if ($_POST['status'] == "Active") echo "selected=\"selected\""; ?>>
                                Active
                            </option>
                            <option value="Inactive" <?php if ($_POST['status'] == "Inactive") echo "selected=\"selected\""; ?>>
                                Inactive
                            </option>

                        <?php else: ?>
                            <option value="Active" <?php if ($result['status'] == "Active") echo "selected=\"selected\""; ?>>
                                Active
                            </option>
                            <option value="Inactive" <?php if ($result['status'] == "Inactive") echo "selected=\"selected\""; ?>>
                                Inactive
                            </option>
                        <?php endif; ?>
                    </select>

                    <input type="hidden"
                           name="id"
                           id="user_id"
                        <?php if (isset($result['user_id'])): ?>
                            value="<?= $result['user_id'] ?>"

                        <?php else: ?>
                            value="<?= $_POST['id'] ?>"
                        <?php endif; ?>
                           hidden>

                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <p>or view <a href="/users">existing</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/javascript/update_validations.js" defer></script>

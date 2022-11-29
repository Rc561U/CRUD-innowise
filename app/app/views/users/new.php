<div class="container" id="container">
    <div class="box">
        <h3 class="display-4 text-center">Create</h3><br>
        <div id="status">

        </div>
        <div class="row">
            <div class="col">
                <form method="post" id="create_form" action="create">

                    <!-- Email unique -->
                    <div class="mb-3 ">
                        <label for="email" class="form-label mb-0">Email address</label>

                        <?php if (isset($errors) && isset($errors['email'])): ?>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= $_POST['email'] ?>" placeholder="name@example.com">
                            <div class="error">
                                <span class="errorMsg"><b><?= $errors['email'] ?></b></span>
                            </div>
                        <?php elseif (isset($_POST['email'])): ?>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= $_POST['email'] ?>" placeholder="name@example.com">
                        <?php else: ?>
                            <input type="email" class="form-control" id="email" name="email" value=""
                                   placeholder="name@example.com">
                        <?php endif; ?>
                    </div>

                    <!-- First and last name -->
                    <div class="mb-3">
                        <label for="name" class="form-label mb-0">Your first and last name</label>
                        <?php if (isset($errors) && isset($errors['name'])): ?>
                            <input type="name" class="form-control" id="name" name="name" value="<?= $_POST['name'] ?>"
                                   placeholder="Jim Royal">
                            <div class="error">
                                <span class="errorMsg"><b><?= $errors['name'] ?></b></span>
                            </div>
                        <?php elseif (isset($_POST['name'])): ?>
                            <input type="name" class="form-control" id="name" name="name" value="<?= $_POST['name'] ?>"
                                   placeholder="name@example.com">
                        <?php else: ?>
                            <input type="name" class="form-control" id="name" name="name" value=""
                                   placeholder="name@example.com">
                        <?php endif; ?>


                    </div>

                    <!-- Gender dropdown -->
                    <div class="mb-3">
                        <label for="gender">Gender</label>
                        <?php if (isset($errors) && isset($errors['gender'])): ?>
                            <select required name="gender" class="form-control text-center" id="gender">
                                <option value="" selected disabled hidden>-- Choose your gender --</option>
                                <option value="Male" <?php $gender = "" ?>;
                                        echo $gender==
                                "Male" ? "selected" : "" ?>Male</option>
                                <option value="Female" <?php echo $gender == "Female" ? "selected" : "" ?>>Female
                                </option>
                            </select>
                            <div class="error">
                                <span class="errorMsg"><b><?= $errors['gender'] ?></b></span>
                            </div>
                        <?php elseif (isset($_POST['gender'])): ?>
                            <select name="gender" class="form-control">
                                <option value="Male" <?php if ($_POST['gender'] == "Male") echo "selected=\"selected\""; ?>>
                                    Male
                                </option>
                                <option value="Female" <?php if ($_POST['gender'] == "Female") echo "selected=\"selected\""; ?>>
                                    Female
                                </option>
                            </select>
                        <?php else: ?>
                            <select name="gender" class="form-control text-center" id="gender">
                                <option value="" selected disabled hidden>-- Choose your gender --</option>
                                <option value="Male" <?php $gender = "" ?>;
                                        echo $gender==
                                "Male" ? "selected" : "" ?>Male</option>
                                <option value="Female" <?php echo $gender == "Female" ? "selected" : "" ?>>Female
                                </option>
                            </select>
                        <?php endif; ?>
                    </div>


                    <!-- Status dropdown -->
                    <div class="mb-3">
                        <label for="status">Status</label>
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
                            <select name="status" class="form-control">
                                <option value="Active" <?php if ($_POST['status'] == "Active") echo "selected=\"selected\""; ?>>
                                    Active
                                </option>
                                <option value="Inactive" <?php if ($_POST['status'] == "Inactive") echo "selected=\"selected\""; ?>>
                                    Inactive
                                </option>
                            </select>
                        <?php else: ?>
                            <select name="status" class="form-control text-center" id="status">
                                <option value="" selected disabled hidden>-- Choose your status --</option>
                                <option value="Active" <?php $status = "" ?>
                                        echo $gender==
                                "Active" ? "selected" : "" ?>Active</option>
                                <option value="Inactive" <?php echo $status == "inactive" ? "selected" : "" ?>>Inactive
                                </option>
                            </select>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <p>or view <a href="/users">existing</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/javascript/JustValidate/create_validation.js" defer></script>
<div class="container">
    <div class="box_main">
        <h1 class="display-4 text-center">Read</h1><br>

        <?php if (isset($status) && $status == "create") { ?>
            <div class="alert-create">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <b>New user successfully created!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>
        <?php if (isset($status) && $status == "update") { ?>
            <div class="alert-update">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <b>User data successfully updated!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>
        <?php if (isset($status) && $status == "delete") { ?>
            <div class="alert-delete">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <b>User has been deleted successfully!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>


        <div class="link-right">
            <button onclick="location.href='users/new'" class="button-1" role="button">Create new user</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><i class="fa fa-envelope" aria-hidden="true"></i>Email</th>
                <th scope="col"><i class="fa fa-user" aria-hidden="true"></i>Full name</th>
                <th scope="col"><i class="fa fa-mars" aria-hidden="true"></i>Gender</th>
                <th scope="col"><i class="fa fa-check-square-o" aria-hidden="true"></i>Status</th>
                <th scope="col"><i class="fa fa-bath" aria-hidden="true"></i>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($result) { ?>

            <?php
            $i = 0;
            foreach ($result as $row) {
                $i++;
                ?>
                <tr data-link="user/<?= $row['user_id'] ?>" data-target="_BLANK">
                    <th scope="row"><?= $i ?></th>
                    <td><?= $row['email'] ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <div class="actions">
                            <a href="users/edit/<?= $row['user_id'] ?>" class="btn" id="btn-success">
                                <button>Update</button>
                            </a>
                            <button id="myBtn" class="btn btn-dark" value="<?= $row['user_id'] ?>">Delete</button>
                        </div>

                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>


        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Are you sure?</h5>
                </div>

                <div class="modal-footer ">
                    <!--                    <a id="delete_link" href="" type="button" class="btn btn-danger">Delete</a>-->
                    <a id="delete_link" href="" type="button" class="">
                        <button type="button">Delete</button>
                    </a>
                    <button type="button" id="close" class="">Cancel</button>
                </div>
            </div>
        </div>


    </div>
</div>
<script rel="stylesheet" src="/assets/javascript/script.js"></script>




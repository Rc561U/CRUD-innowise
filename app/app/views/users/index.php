<div class="container" id="container">
    <div class="box_main">
        <h1 class="display-4 text-center">Read</h1><br>

        <?php if (isset($status) && $status == "create") { ?>
            <div class="alert alert-success" role="alert">
                <b>New user successfully created!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>
        <?php if (isset($status) && $status == "update") { ?>
            <div class="alert alert-info" role="alert">
                <b>User data successfully updated!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>
        <?php if (isset($status) && $status == "MultipleDelete") { ?>
            <div class="alert alert-warning" role="alert">
                <b>Users has been successfully deleted!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>
        <?php if (isset($status) && $status == "delete") { ?>
            <div class="alert alert-warning" role="alert">
                <b>User has been deleted successfully!</b>
                <?php unset($_SESSION['status']) ?>
            </div>
        <?php } ?>

        <div class="link-right">
            <div class="d-flex h-100">
            </div>
            <div class="container h-100">
                <div class="d-flex h-100">
                    <div class="align-self-start mr-auto">
                        <button onclick="location.href='users/new'" class="btn btn-primary" role="button">Create new
                            user
                        </button>
                    </div>
                    <div class="align-self-center mx-auto">
                        <!--                        <button type="button" id="multiple_delete" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#multipleDeleteModal" disabled>-->
                        <!--                            test-->
                        <!--                        </button>-->
                    </div>
                    <div class="align-self-end ml-auto">
                        <button type="button" class="btn btn-outline-secondary" id="MultiDelete" data-bs-toggle="modal"
                                data-bs-target="#multipleDeleteModal" disabled>
                            Delete selected
                        </button>
                    </div>
                </div>
            </div>
            <p id="result" class="text-success"></p>

        </div>
        <table class="table  table-hover table-responsive-md-sm">
            <thead>
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                    </div>
                </th>
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
                    <th>
                        <div class="form-check">
                            <label><input class="form-check-input" type="checkbox" id="checkbox"
                                          value="<?= $row['user_id'] ?>"></label>
                        </div>
                    </th>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $row['email'] ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="users/edit/<?= $row['user_id'] ?>">
                            <button class="btn btn-success">Update</button>
                        </a>
                        <button type="button" class="btn btn-danger" id="monoDelete" value="<?= $row['user_id'] ?>"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
        <?= $pagination ?>
        <!-- Modal 1 -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Are you sure?</h5>
                    </div>
                    <div class="modal-footer w-100 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a id="delete_link" href="">
                            <button class="btn btn-warning">Delete</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2 -->
        <div class="modal fade" id="multipleDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Are you sure?</h5>
                    </div>
                    <div class="modal-footer w-100 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="multiple_delete" class="btn btn-warning">Delete</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script rel="stylesheet" src="/assets/javascript/script.js"></script>

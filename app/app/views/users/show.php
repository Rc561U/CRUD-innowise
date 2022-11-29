<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container" id="container">
    <div class="box-show">
        <h2>Information about <i><?php echo $result['full_name']; ?></i></h2>
        <table class="table table-striped">
            <tr>
                <th>Email</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['full_name']; ?></td>
                <td><?php echo $result['gender']; ?></td>
                <td><?php echo $result['status']; ?></td>
                <td>
                    <a href="/users/edit/<?= $result['user_id'] ?>" class="btn" id="btn-success"><i
                                class="fa fa-pencil-square fa-2x" aria-hidden="true"></i></a>
                    <a href="/users/delete/<?= $result['user_id'] ?>" class="btn" id="btn-danger"><i
                                class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                </td>

                </td>
            </tr>
        </table>
        <div class="link-right">
            <a href="/users" class="link-primary">Return</a>
        </div>

    </div>
</div>

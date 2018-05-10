<section class="crud">
    <ul class="crud_row-title">
        <li>User email</li>
        <li>RegDate</li>
        <li>Role</li>
        <li>Is active</li>
        <li>Operations</li>
    </ul>
    <?php if (empty($users)): ?>
        <ul class="crud_row">
            <li>Not found</li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    <?php else: ?>
        <?php foreach ($users as $value): ?>
            <ul class="crud_row">
                <input type="hidden" name="id" value="<?= $value["id"] ?>">

                <?php if (getSESSION("email") === $value["email"]): ?>
                    <li class="email"><b><?= $value["email"] ?>(You)</b></li>
                <?php else: ?>
                    <li class="email"><?= $value["email"] ?></li>
                <?php endif; ?>

                <li class="regdate"><?= $value["regdate"] ?></li>
                <li class="role"><?= $value["role"] ?></li>
                <li class="isactive"><?php echo $value["is_active"] ? "Yes" : "No" ?></li>
                <li>
                    <button type="button" title="Edit" class="action edit" value="<?= $value["email"] ?>">
                        <i class="fa fa-pencil fa-lg"></i>
                    </button>
                    <button type="button" title="Delete" class="danger del" value="<?= $value["email"] ?>">
                        <i class="fa fa-trash-o fa-lg"></i>
                    </button>
                </li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
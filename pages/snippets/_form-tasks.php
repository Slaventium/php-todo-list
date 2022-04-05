<form method="post">
    <div>
        <label for="task">
            Task:
        </label>
        <input type="text" name="task" id="task" value="<?php
        echo isset($normalizedData['task'])
            ? htmlspecialchars($normalizedData['task'], ENT_QUOTES)
            : '';
        ?>">
        <?php
        if (isset($formErrors['task'])) {
            ?>
            <strong><?php echo $formErrors['task']; ?></strong>
            <?php
        }
        ?>
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>
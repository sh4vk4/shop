<?

echo '

<div class="modal">
    <div class="modal-body">
        <p>Are you sure you want to delete this account?</p>
        <form action="delete.php" method="post">
            <button class="secondary" type="submit" name="delete" id="delete">Yes, delete the account</button>
            <button class="primary" type="submit" name="not_delete" id="not_delete">No, keep the account</button>
        </form>
    </div>
</div>

'

?>
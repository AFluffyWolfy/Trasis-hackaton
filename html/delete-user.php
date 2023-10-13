<form class="background-blue">
    <button type="button" onclick="closeDeleteForm()" class="close-button | with-border font-default fs-500 hover-light" id="close_form">
        <span class="material-symbols-outlined">
            close
        </span>
    </button>
    <h2 class="background-lightblue txt-lightaccent font-default fs-400">Do you really want to archive the user?</h2>
    <input type="submit" class="background-gold with-border font-default fs-400 hover-light" id="archive_user" value="Confirm">
    <input type="submit" class="background-negative with-border font-default fs-400 hover-light txt-lightaccent" id="not_archive_user" value="Cancel">
    <input type="hidden" id="idDeletedUser" value="0"/>
</form>
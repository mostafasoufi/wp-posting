<div class="misc-pub-section misc-pub-posting" id="posting">
    <div id="post-posting-select">
        <span>Post To: </span>
        <select name="posting_website_id">
            <option value="0">None</option>
            <?php foreach (\WP_Posting\Setting::getWebsites() as $key => $value) : ?>
                <option value="<?php echo $key; ?>"><?php echo $key; ?></option>
            <?php endforeach; ?>
        </select>

        <select name="posting_status">
            <option value="draft">Draft</option>
            <option value="publish">Publish</option>
        </select>
    </div>
</div>
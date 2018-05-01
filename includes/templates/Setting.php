<div class="wrap">
    <?php add_thickbox(); ?>
    <div id="wp-posting-box" style="display:none;">
        <form method='post'>
            <h2>Add new website</h2>
            <p><label for="name">Name: </label><br><input required="required" id="name" type="text" value=""
                                                          name="name"/></p>
            <p><label for="username">Username: </label><br><input required="required" id="username" type="text" value=""
                                                                  name="username"/></p>
            <p><label for="password">Password: </label><br><input required="required" id="password" type="text" value=""
                                                                  name="password"/></p>
            <p><label for="api_url">API URL: </label><br><input required="required" id="api_url" type="text" value=""
                                                                name="api_url"/></p>
            <?php submit_button(); ?>
        </form>
    </div>

    <h2 style="display: inline-grid;margin-right: 7px;">WP-Posting Setting</h2>
    <a href="#TB_inline?width=500&height=400&inlineId=wp-posting-box" class="thickbox">Add new</a>
    <table class="wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <th class="manage-column"><span>Website name</span></th>
            <th class="manage-column"><span>Username</span></th>
            <th class="manage-column"><span>API URL</span></th>
            <th class="manage-column"><span>Action</span></th>
        </tr>
        </thead>

        <tbody id="the-list">
        <?php if (\WP_Posting\Setting::getWebsites()): ?>
            <?php foreach (\WP_Posting\Setting::getWebsites() as $key => $value) : ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value['username'] ?></td>
                    <td><?php echo $value['api_url'] ?></td>
                    <td>
                        <a href="options-general.php?page=wp-posting&action=delete&website=<?php echo $key; ?>"><span
                                    class="dashicons dashicons-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <td colspan="5">Please add new website.</td>
        <?php endif; ?>
        </tbody>

        <tfoot>
        <tr>
            <th class="manage-column"><span>Website name</span></th>
            <th class="manage-column"><span>Username</span></th>
            <th class="manage-column"><span>API URL</span></th>
            <th class="manage-column"><span>Action</span></th>
        </tr>
        </tfoot>
    </table>
</div>

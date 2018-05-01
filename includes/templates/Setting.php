<div class="wrap">
    <?php add_thickbox(); ?>
    <div id="my-content-id" style="display:none;">
        <form method='post'>
            <h2>Add new website</h2>
            <p><label for="username">Username: </label><br><input id="username" type="text" value="" name="username"/></p>
            <p><label for="password">Password: </label><br><input id="password" type="text" value="" name="password"/></p>
            <p><label for="api_url">API URL: </label><br><input id="api_url" type="text" value="" name="api_url"/></p>
            <?php submit_button(); ?>
        </form>
    </div>

    <h2 style="display: inline-grid;margin-right: 7px;">WP-Posting Setting</h2>
    <a href="#TB_inline?width=500&height=350&inlineId=my-content-id" class="thickbox">Add new</a>
    <table class="wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <th class="manage-column"><span>Website name</span></th>
            <th class="manage-column"><span>Username</span></th>
            <th class="manage-column"><span>Password</span></th>
            <th class="manage-column"><span>API URL</span></th>
            <th class="manage-column"><span>Action</span></th>
        </tr>
        </thead>

        <tbody id="the-list">
        <tr>
            <td>fdf</td>
            <td>fdf</td>
            <td>fdf</td>
            <td>fdf</td>
            <td>
                <a href="options-general.php?page=wp-posting&action=delete&id="><span
                            class="dashicons dashicons-trash"></span></a>
            </td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
            <th class="manage-column"><span>Website name</span></th>
            <th class="manage-column"><span>Username</span></th>
            <th class="manage-column"><span>Password</span></th>
            <th class="manage-column"><span>API URL</span></th>
            <th class="manage-column"><span>Action</span></th>
        </tr>
        </tfoot>
    </table>
</div>

# WP-Posting
This plugin sends the post (Title, Content and Thumbnail) to another WordPress with WP-Rest API

## Authentication Plugins
To sending the post, the plugin needs authentication for each website, The below plugins required to install.
####[Application Passwords](https://wordpress.org/plugins/application-passwords/)
With Application Passwords you are able to authenticate a user without providing that user’s password directly, instead you will use a base64 encoded string of their username and a new application password.


####[Basic Authentication](https://github.com/WP-API/Basic-Auth)
Note that this plugin requires sending your username and password with every request, and should only be used for development and testing i.e. not in a production environment.

I've suggest you using the Application Passwords plugin for authentication.


##Converting Custom Meta to Terms in Custom Taxonomies

### Why would this be used?

In sites which have already been set up to an exent by a WordPress Practitioner, I often find them using custom meta for data points. This is because the UI is easily accessible and popular pagebuilders like Visual Composer enable one to output and style the meta. 

However when meta is used to save data that should be saved as terms, its a bad idea because:

1. Many attempt to query by post meta which is a gigantic [performance issue.](https://tomjn.com/2016/12/05/post-meta-abuse/)
2. It removes WP's ability to generate archive pages by topic.
3. We want dont want one value saved in many places. Especially if it can be spelled wrong.

This code provides a solution by creating custom taxonomies by the meta key name, and adding in meta values as terms. It also gives you the option to preserve the custom fields, and the meta data so that you don't disrupt pagebuilders or theme templates.

### How to use it?

#### Use it in a Theme

Include it in your theme before activation. The code to match up the terms will run on theme activation.

In the code set:
$custom_post_type_slug to the post type you want to target, I.e post, product page etc.
$taxonomy_names with an array of slug, and nice names for your custom taxonomies.
$taxandmetatoset with an array that matches up the taxonomy to the meta key you want to remove.

This code allows one to dually store data in both Custom Meta fields and as taxonomy terms. This is to preserve the custom fields input since removing it completely would be disruptive to existing page builder pages, templates, and the content editing workflow.

The meta data is converted to term data when the post is published. If you need to associate terms with posts of other statuses (like draft), you can add more actions to the corresponding status hooks.


#### Use it in a plugin 

Do all of the above and switch out the on after_switch_theme with register_activation_hook on line 66.

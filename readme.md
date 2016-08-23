##Converting Custom Meta to Terms in Custom Taxonomies

### Why would this be used?

In sites which have already been set up to an exent by a WordPress Practitioner, I often find them using custom meta for data points. This is because the UI is easily accessible and popular pagebuilders like Visual Composer enable one to output and style the meta. 

However since Meta and Posts have a one to one relationship, it is not ideal if the data point really has a one to many relationship with Posts. For example, if the data point was State, and values could be any state, one could have 'Texas' spelled correctly for one post but not another. It also closes off WordPress' ability to create taxonomy archives and show the connections between posts.

This code provides a solution by creating custom taxonomies and adding in metadata as terms. 

### Where would you use it?

This can be used in either a plugin(reccomended) or a theme. Just change the activation hook. 

### How does it work?
Upon activation it registers the meta field key as a custom taxonomy. Then it cycles through all posts of a given post type and adds their metadata to the taxonomy as terms while also associating the terms with the post.

It also preserves the custom fields input since removing it completely would be disruptive to existing Visual Composer pages, and the content editing workflow.

Any values added to the metadata are also associated with the post whenever a post is published. If one wishes to be able to associate terms with posts of other statuses, one can add more actions to the corresponding hooks.
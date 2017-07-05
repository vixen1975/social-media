# social-media
Adds social media icons using IcoMoon custom font.

To use:
Simply add the following snippet where you want your icons to appear:
<% if SocialMediaIcons %>
  <% loop SocialMediaIcons %>
    $SMIcons
  <% end_loop %>
<% end_if %>

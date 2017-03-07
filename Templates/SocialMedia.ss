
<% if IconClass = fa-phone %>
  <div class="fa-icon $IconStyle <% if ShowTitle %>auto-width<% end_if %> $ColourScheme">
    <a tel="$Url" id="icon-phone"><span class="$IconClass icon"></span><% if ShowTitle %>$Title<% end_if %></a>
  </div>
  <div class="popup">$Url</div>
<% else_if IconClass = fa-email || IconClass = fa-envelope %>
  <div class="fa-icon $IconStyle <% if ShowTitle %>auto-width<% end_if %> $ColourScheme">
    <a href="mailto:$Url"><span class="$IconClass icon"></span><% if ShowTitle %>$Title<% end_if %></a>
  </div>
<% else %>
  <div class="fa-icon $IconStyle <% if ShowTitle %>auto-width<% end_if %> $ColourScheme">
  	<a href="../../fa-icons/Templates/$Url" target="_blank"><span class="$IconClass icon"></span><% if ShowTitle %>$Title<% end_if %></a>
  </div>
<% end_if %>
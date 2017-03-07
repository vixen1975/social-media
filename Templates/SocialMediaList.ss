<div class="social-media $Class">
  $Caption
  <% if Icons %>
    <% loop Icons %>
<a href="<% if IconClass = fa-email || IconClass = fa-envelope %>mailto:$Url<% else %>$Url<% end_if %>" target="_blank"><span class="fa-icon $IconClass"></span> <span class="title">$Title</span></a>
    <% end_loop %>
  <% end_if %>
</div>



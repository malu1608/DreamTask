<article class="card">
<header>
  <h2>{{$title}}</h2>
</header>
<ul>
  @each('partials.task', $tasks, 'task')
</ul>
<form class="new_item">
  <input type="text" name="description" placeholder="new item">
</form>
</article>

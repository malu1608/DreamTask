<article class="card">
<header>
  <h2>{{$title}}</h2>
</header>
<ul>
  @each('partials.task', $tasks, 'task')
</ul>
<form action="/tasksCreate" class="new_item" method="post">
  @csrf
  <input type="number" name="id_team" value="{{$team_id}}" style="display:none;">
  <input type="text" name="title" placeholder="new title" required>
  <input type="text" name="description" placeholder="new description" required>
  <input type="text" name="task_status" value="{{$title}}" style="display:none;">
  <button type="submit">Create</button>
</form>
</article>

@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="about-section">
  <h1>About Us:</h1>
  <p>The purpose of this project is to develop a web application called DreamTask, which is a project management system that will be developed by a small software company, mainly to  define and organize all possible tasks or goals to be achieved individually or as a team.</p>
  <p>This App will be developed by a small team of software engineers, and will allow any type of user, whether corporate related like startups, consultants, small companies, large businesses, and many others, to have control of all their workflow. Any team of employees would benefit the most from this application since it will allow them to achieve professional success by controlling and planning their activities and by helping to build the right line-up in order to assemble the perfect project.
In terms of operation, before the creation of a project, there has to be a workspace associated with that company, with all types of registered users: board members, administrators and people that might be relevant for the development of the project (observers and guests for instance). Each project has at least a  team and task lists that are assigned to those members,  tracking the one that defined that task as well as the one who completed it. Tasks inside the lists can be directed to groups and have upcoming deadlines and priority levels. Each team has a team coordinator. A search engine dedicated to finding the respective teams/tasks associated with each individual.</p>
  <p>There is also a discussion forum to react to changes, proposals or issues. All types of information relevant to the individual or team, like a job promotion, an accomplished task, a new challenge in the workspace, or simply a new message in the forum, will be showcased as a notification, to reinforce the user's attention. Concerning the members of the workspace, authenticated users can have different permissions according to their privileges, whether being admins (the ones who have full responsibility over the management of the system) or regular members.</p>
  <p>It is possible to change who adds members to a board: they can be selected by administrators only (with complete access and modification privileges that include adding and removing members) or by admins and members of the board. In both cases admins can add , edit and remove tasks by team members. Additionally, team members can switch projects in their workspace.</p>
  <p>The commenting permission (deleting, adding and editing comments), on which the discussion forum mentioned above relies, is always controlled by admins. The default setting allows all members that are logged in to comment.</p>
  <p>In terms of the design and structure of the application, the aim is to maintain an easy-to-use and transparent navigation system, accompanied by an appealing visual appearance to new visitors or potential customers of our product.</p>
</div>
@endsection
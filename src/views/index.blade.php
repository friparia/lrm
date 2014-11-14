<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title></title>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<style>
header{
  position:fixed;
  top:0;
  right:0;
  left:0;
  height:50px;
  background-color:rgba(230,230,230,.8);
  z-index:9999
}
.logo{
  position:absolute;
  top:13px;
  left:15px;
  width:73px;
  height:24px;
}
.content{z-index:0;margin:2em;padding-top:25px}
.content>h1{
  border-bottom:1px solid #ccc;
  padding-bottom:.2em;
}
.content table{
  width:100%;
  table-layout:fixed;
  overflow:hidden;
  font-size:.9em;
}
.content table th{
  text-align:left;
  border-bottom:1px solid #f4726d;
}
.content table td, .content table th{
  padding:.5em 1em;
}
.method-tag{
  font-weight:700;
  color:#fff;
  display:inline-block;
  padding:.5em 1em;
  font-size:.6em;
  text-align:center;
  border-radius:5px;
}
.method-tag-get{background-color:#9ed646}
.method-tag-delete{background-color:#e53c5c}
.method-tag-post{background-color:#e5c73c}
.method-tag-patch,.method-tag-put{background-color:#3a99fa}
.lrm{position:absolute;right:10px;top:11px;display:inline-block;text-transform:uppercase;font-size:.8em;background-color:#fff;border-radius:3px;padding:.5em 1em;color:#777;}
</style>
<script>
$(document).ready(function(){
    $('.deleteBtn').click(function(){
      var id = $(this).attr('data-id');
      $.ajax({
url : 'lrm/'+id,
dataType : 'json',
type : 'DELETE',
success : function(){
location.reload();
}
});
      });
    });
</script>
</head>
<body>
<header>
  <img src="http://laravel.com/assets/img/logo-foot.png" alt="Laravel" class="logo">
  <span></span>
  <span class="lrm">LARAVEL ROUTING MANAGEMENT</span>
</header>
<div class="container">
  <div class="content">
    <h1>Routing Table</h1>
    <table style="width:100%">
      <thead>
        <tr>
          <th>HTTP Method</th>
          <th>Route</th>
          <th>Corresponding Action</th>
          <th>Operation</th>
        </tr>
      </thead>
      <tbody>
      @while ($route = current($routes))
      <tr>
        <td><span class="method-tag method-tag-{{ strtolower($route->getMethods()[0]) }}">{{ $route->getMethods()[0] }}</span></td>
        <td>{{ $route->getPath() }}</td>
        <td>{{ $route->getActionName() }}</td>
        <td>
          <button class="btn btn-default deleteBtn" data-id="{{ key($routes) }}">Delete</button>
        </td>
      </tr>
      <?php next($routes); ?>
      @endwhile
      </tbody>
    </table>
    <h1>Add A Route</h1>
    <form method="post" action="lrm" class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">Route</label>
        <div class="col-sm-10">
          <input class="form-control" name="uri" type="text"/>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Method</label>
        <div class="col-sm-10">
          <select class="form-control" name="method">
            <option value="get">GET</option>
            <option value="post">POST</option>
            <option value="put">PUT</option>
            <option value="patch">PATCH</option>
            <option value="delete">DELETE</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">Corresponding Action</label>
        <div class="col-sm-10">
          <input class="form-control" name="action" type="text"/>
        </div>
      </div>
      <button class="btn btn-default">Submit</button>
    </form>

  </div>
</div>
</body>
</html>

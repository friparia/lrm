<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
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
    <form method="post" action="lrm">
      路由<input name="uri" type="text"/>
      请求方法<select name="method">
        <option value="get">GET</option>
        <option value="post">POST</option>
        <option value="put">PUT</option>
        <option value="patch">PATCH</option>
        <option value="delete">DELETE</option>
      </select>
      通信方法<input name="action" type="text"/>
      <button>提交</button>
    </form>

    <table style="width:100%">
      <tr>
        <td width="10%"><h4>HTTP Method</h4></td>
        <td width="10%"><h4>Route</h4></td>
        <td width="10%"><h4>Corresponding Action</h4></td>
        <td width="10%">
          <h4>Operation</h4>
        </td>
      </tr>
      @while ($route = current($routes))
      <tr>
        <td>{{ $route->getMethods()[0] }}</td>
        <td>{{ $route->getPath() }}</td>
        <td>{{ $route->getActionName() }}</td>
        <td><button class="deleteBtn" data-id="{{ key($routes) }}">删除</button>
</td>
      </tr>
      <?php next($routes); ?>
      @endwhile
    </table>

  </body>
</html>

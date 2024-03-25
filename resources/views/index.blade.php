<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>代办事项列表</title>
</head>
<body>
<h1>我的代办事项</h1>
<form action="add_task.php" method="post">
<input type="text" name="task" placeholder="添加新的代办事项">
<button type="submit">添加</button>
</form>
<ul id="taskList">
<!-- 代办事项列表将在这里显示 -->
</ul>

<script>
// 这里可以添加一些JavaScript代码，用于异步从后端获取代办事项列表
// 并更新到页面上
</script>
</body>
</html>

<html>
<head>
    <!-- 导入Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body>
    <div x-data="todoApp()" x-init="getTodos()">
        <input type="text" x-model="newTodo">
        <button @click="addTodo">添加</button>

        <ul>
            <template x-for="todo in todos" :key="todo.id">
                <li>
                    <input type="checkbox" x-model="todo.completed" @change="updateTodo(todo)">
                    <span x-text="todo.title" :class="{ 'line-through': todo.completed }"></span>
                    <button @click="deleteTodo(todo.id)">删除</button>
                </li>
            </template>
        </ul>
    </div>

    <script>
        function todoApp() {
            return {
                todos: [],
                newTodo: '',
                async addTodo() {
                    const response = await fetch('/api/todos', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ title: this.newTodo }),
                    });
                    const todo = await response.json();
                    this.todos.push(todo);
                    this.newTodo = '';
                },
                async deleteTodo(todoId) {
                    await fetch(`/api/todos/${todoId}`, {
                        method: 'DELETE',
                    });
                    this.todos = this.todos.filter(todo => todo.id !== todoId);
                },
                async updateTodo(todo) {
                    await fetch(`/api/todos/${todo.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            title: todo.title,
                            completed: todo.completed,
                        }),
                    });
                },
                async getTodos() {
                  const response = await fetch('http://localhost/api/todos'); // 确保请求的URL前加上/api前缀
                    if (response.ok) {
                        this.todos = await response.json();
                    } else {
                        console.error('Failed to fetch todos');
                    }
                },

            };
        }
        todoApp().getTodos();
    </script>
</body>
</html>

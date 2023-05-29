import { useEffect, useContext } from 'react';
import { Link } from 'react-router-dom'
import TodoContext from '../../Context/TodoContext';

export const TodoIndex = () => {
    const { todos, getTodos, deleteTodo } = useContext(TodoContext);
    useEffect(() => {
        getTodos();
    }, []);

    return (
        <div className="mt-12">

			<h1 className="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Todos</h1>

			<div className="flex justify-end m-2 p-2">
			<Link to="/todos/create" className="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">
				Create Todo
			</Link>
			</div>

			<div className="relative overflow-x-auto">
			    <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
			        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			            <tr>
			                <th scope="col" className="px-6 py-3">
			                    Title
			                </th>
			                <th scope="col" className="px-6 py-3">
			                    Description
			                </th>
			                <th scope="col" className="px-6 py-3">
			                    Action
			                </th>
			            </tr>
			        </thead>
			        <tbody>
			            { todos.map( (todo) => {
			            	return (
			            		<tr key={ todo.id } className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
				                <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
				                    { todo.title }
				                </th>
				                <td className="px-6 py-4">
				                    { todo.description }
				                </td>
				                <td className="px-6 py-4 space-x-2">
				                    <Link to={`/todos/${todo.id}/edit`} className="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">
										Edit
									</Link>
									<button onClick = { () => deleteTodo(todo.id) } className="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">
										Delete
									</button>
				                </td>
				            </tr>
			            	);
			            } ) 
			        	}
			        </tbody>
			    </table>
			</div>

		</div>
    );
}
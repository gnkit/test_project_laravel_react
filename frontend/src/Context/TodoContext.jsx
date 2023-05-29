import { createContext, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';


axios.defaults.baseURL = 'http://localhost:8080/api/v1/';


const TodoContext = createContext();

export const TodoProvider = ({ children }) => {

	// const getCSRFToken = async () => {
	//     const response = await axios.get('http://localhost:8080/sanctum/csrf-cookie');
	//    		axios.defaults.headers.post['X-CSRF-Token'] = response.data.CSRFToken;
 	// };

	const [ formValues, setFormValues ] = useState({
		title: '',
		description: '',
	});

	const [ todos, setTodos ] = useState([]);
	const [ todo, setTodo ] = useState([]);
	const [ errors, setErrors ] = useState({});
	const navigate = useNavigate();

	const onChange = (e) => {
		const { name, value } = e.target;
		setFormValues({ ...formValues, [ name ]: value });
	};

	const getTodos = async () => {
		const apiTodos = await axios.get('todos');
		setTodos(apiTodos.data.data);
	};

	const getTodo = async (todo) => {
		const response = await axios.get('todos/' + todo);
		const apiTodo = response.data.data;
		setTodo(apiTodo);
		setFormValues({
			id: apiTodo.id,
			title: apiTodo.title,
			description: apiTodo.description,
		});
	};

	const storeTodo = async (e) => {
		e.preventDefault();
		try {
			await axios.post('todos', formValues);
			// getCSRFToken();
			getTodos();
			navigate('/todos');
		} catch(e) {
			if(e.response.status === 422) {
				setErrors(e.response.data.errors);
			}
		}
	};

	const updateTodo = async (e) => {
		e.preventDefault();
		try {
			await axios.put('todos/' + todo.id, formValues);
			// getCSRFToken();
			getTodos();
			navigate('/todos');
		} catch(e) {
			if(e.response.status === 422) {
				setErrors(e.response.data.errors);
			}
		}
	};

	const deleteTodo = async(id) => {
		axios.delete('todos/' + id);
		getTodos();
		navigate('/todos');
	}


	return (
		<TodoContext.Provider value={{ todo, todos, getTodo, getTodos, onChange, formValues, storeTodo, updateTodo, deleteTodo, errors, }}>
			{ children }
		</TodoContext.Provider>
	);
};


export default TodoContext
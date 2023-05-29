import { useContext } from 'react';
import TodoContext from '../../Context/TodoContext';

export const TodoCreate = () => {
    const { formValues, onChange, storeTodo, errors } = useContext(TodoContext);
    return (
        <div className="mt-12">
			<h1 className="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">TodoCreate</h1>

			<form onSubmit={ storeTodo } className="max-w-md mx-auto p-4 bg-white shadow-md rounded-sm">
				<div className="space-y-6">
					<div className="mb-4">
						<label htmlFor="title" className="block mb-2 text-sm font-medium">
							Title
						</label>
						<input 
							name="title" 
							type="text" 
							value={ formValues["title"] } 
							onChange={ onChange } 
							className=" border border-gray-300 text-gray900 text-sm rounded-md block w-full p-2" 
						/>
						{ errors.title && <span className="text-sm text-red-400">{ errors.title[0] }</span> }
					</div>
					<div className="mb-4">					
						<label htmlFor="description" className="block mb-2 text-sm font-medium">
							Description
						</label>
						<textarea name="description"
							type="test"
							value={ formValues["description"] }
							onChange={ onChange } rows="4" className="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
						
						{ errors.description && <span className="text-sm text-red-400">{ errors.description[0] }</span> }
					</div>
					<div className="my-4">
						<button className="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">
							Store
						</button>
					</div>
				</div>
			</form>
		</div>
    );
}
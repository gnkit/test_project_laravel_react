import { Routes, Route, Link } from 'react-router-dom'

import { TodoProvider } from './Context/TodoContext';
import { Home } from './components/Home';
import { TodoIndex } from './components/todos/TodoIndex';
import { TodoCreate } from './components/todos/TodoCreate';
import { TodoEdit } from './components/todos/TodoEdit';


function App() {
  return (
    <TodoProvider>
        <div className="bg-slate-200">
            <div className="max-w-7xl mx-auto min-h-screen">
                <nav>
                    <ul className="flex">
                        <li className="m-2 p-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">
                            <Link to="/">Home</Link>
                        </li>
                        <li className="m-2 p-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">
                            <Link to="/todos">Todos</Link>
                        </li>
                    </ul>
                </nav>
                <Routes>
                    <Route path="/" element={ <Home /> } />
                    <Route path="/todos" element={ <TodoIndex /> } />
                    <Route path="/todos/create" element={ <TodoCreate /> } />
                    <Route path="/todos/:id/edit" element={ <TodoEdit /> } />
                </Routes>
            </div>
        </div>
    </TodoProvider>
    );
}

export default App;

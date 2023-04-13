import {createBrowserRouter, RouterProvider} from 'react-router-dom';
import Home from './components/Home/Home'
import Login from './components/login/login';
import Register from './components/registro/register';
import Birds from './components/birds/Birds'

function App() {
  const router = createBrowserRouter([
    {
      path:"/",
      element:<><Home /> <Birds /> </>
    },
    {
      path:"/Register",
      element:<><Register />  </>
    },
    {
      path:"/Login",
      element:<><Login /> </>
    },
    

  ]);

  return (
    <div className="App">
          <RouterProvider router={router} />
    </div>
  );
}

export default App;


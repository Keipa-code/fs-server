import './App.css';
import Home from './components/Home'
import { BrowserRouter, Route, Switch} from "react-router-dom";
import NotFound from "./Error/NotFound";

function App() {
  return (
    <BrowserRouter>
    <div className="App">
      <Switch>
        <Route exact path="/">
          <Home />
        </Route>
        <Route path="*">
          <NotFound />
        </Route>
      </Switch>

    </div>
    </BrowserRouter>
  );
}

export default App;
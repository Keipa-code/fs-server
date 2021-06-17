import './App.css';
import Welcome from './components/Welcome'
import { BrowserRouter, Route, Switch} from "react-router-dom";
import NotFound from "./Error/NotFound";

function App() {
  return (
    <BrowserRouter>
    <div className="App">
      <Switch>
        <Route exact path="/">
          <Welcome />
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

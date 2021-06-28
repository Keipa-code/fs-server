import './App.css';
import Home from './components/Home'
import FindList from './FilesList/FilesList'
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
        <Route exact path="/search">
          <FindList />
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

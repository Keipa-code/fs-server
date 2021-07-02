import './App.css';
import Home from './Home/Home'
import FindList from './BrowseFiles/FilesList'
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
        <Route path="/search">
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
